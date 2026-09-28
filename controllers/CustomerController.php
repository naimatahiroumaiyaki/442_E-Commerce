<?php

require_once "../classes/CustomerClass.php";

class CustomerController
{
    private $customer;

    public function __construct()
    {
        $this->customer = new Customer();
    }

    public function register($data)
    {
        if ($this->customer->emailExists($data['email'])) {
            return [
                'success' => false,
                'error' => 'Email already registered'
            ];
        }

        $success = $this->customer->addCustomer(
            $data['name'],
            $data['email'],
            $data['pass'],
            $data['country'],
            $data['city'],
            $data['contact']
        );

        if ($success) {
            return [
                'success' => true
            ];
        }

        return [
            'success' => false,
            'error' => 'Registration failed'
        ];
    }

    public function login($email, $pass)
    {
        $customer = $this->customer->login($email, $pass);

        if ($customer) {
            return $customer;
        }

        return [
            'success' => false,
            'error' => 'Invalid email or password'
        ];
    }
}
?>