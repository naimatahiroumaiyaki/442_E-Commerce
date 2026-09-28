<?php

require_once '../core/db_class.php';

class Customer extends Database
{
    // Check if the email of a customer already exists
    public function emailExists($email)
    {
        $stmt = $this->conn->prepare(
            'SELECT customer_email FROM customer WHERE customer_email = ?'
        );

        $stmt->bind_param('s', $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $exists = $result->num_rows > 0;

        $stmt->close();

        return $exists;
    }

    // Add a new customer to the database
    public function addCustomer($name, $email, $pass, $country, $city, $contact)
    {
        $hash = password_hash($pass, PASSWORD_BCRYPT);

        $stmt = $this->conn->prepare(
            'INSERT INTO customer
            (customer_name, customer_email, customer_pass,
             customer_country, customer_city, customer_contact)
            VALUES (?, ?, ?, ?, ?, ?)'
        );

        $stmt->bind_param(
            'ssssss',
            $name,
            $email,
            $hash,
            $country,
            $city,
            $contact
        );

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }

    // Get a customer by email
    public function getCustomerByEmail($email)
    {
        $stmt = $this->conn->prepare(
            'SELECT * FROM customer WHERE customer_email = ?'
        );

        $stmt->bind_param('s', $email);
        $stmt->execute();

        $stmt->bind_result(
            $customer_id,
            $customer_name,
            $customer_email,
            $customer_pass,
            $customer_country,
            $customer_city,
            $customer_contact,
            $customer_image,
            $user_role
        );

        if ($stmt->fetch()) {

            $customer = [
                'customer_id' => $customer_id,
                'customer_name' => $customer_name,
                'customer_email' => $customer_email,
                'customer_pass' => $customer_pass,
                'customer_country' => $customer_country,
                'customer_city' => $customer_city,
                'customer_contact' => $customer_contact,
                'customer_image' => $customer_image,
                'user_role' => $user_role
            ];

            $stmt->close();

            return $customer;
        }

        $stmt->close();

        return false;
    }
    // Login
    public function login($email, $pass)
    {
        $customer = $this->getCustomerByEmail($email);

        if ($customer && password_verify($pass, $customer['customer_pass'])) {
            return $customer;
        }

        return false;
    }
}
?>