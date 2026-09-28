<?php

require_once '../core/core.php';
require_once '../controllers/CustomerController.php';

// Check the request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect("../views/login.php");
}

// Get the form data
$email = trim(strip_tags($_POST['email'] ?? ''));
$pass = trim($_POST['pass'] ?? '');

// Check if the fields are empty
if ($email === '' || $pass === '') {
    $_SESSION['error'] = 'Email and password are required';
    redirect("../views/login.php");
}

// Call the controller
$controller = new CustomerController();
$result = $controller->login($email, $pass);

// If login is successful
if (isset($result['customer_id'])) {
    $_SESSION['customer_id'] = $result['customer_id'];
    $_SESSION['customer_name'] = $result['customer_name'];
    $_SESSION['customer_email'] = $result['customer_email'];
    $_SESSION['user_role'] = $result['user_role'];

    redirect("../index.php");
}

// Login failed
$_SESSION['error'] = $result['error'];
redirect("../views/login.php");

?>