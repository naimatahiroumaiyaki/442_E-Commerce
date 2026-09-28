<?php

require_once "../core/core.php";
require_once "../controllers/CustomerController.php";

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect("../views/register.php");
}

// Get form data
$name = trim(strip_tags($_POST['name'] ?? ''));
$email = trim(strip_tags($_POST['email'] ?? ''));
$pass = trim($_POST['pass'] ?? '');
$country = trim(strip_tags($_POST['country'] ?? ''));
$city = trim(strip_tags($_POST['city'] ?? ''));
$contact = trim(strip_tags($_POST['contact'] ?? ''));

// Check that all fields are filled
if (
    $name === '' ||
    $email === '' ||
    $pass === '' ||
    $country === '' ||
    $city === '' ||
    $contact === ''
) {
    $_SESSION['error'] = 'All fields are required.';
    redirect("../views/register.php");
}

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'Invalid email address.';
    redirect("../views/register.php");
}

// Check field lengths
if (
    strlen($name) > 100 ||
    strlen($email) > 50 ||
    strlen($pass) > 150 ||
    strlen($country) > 30 ||
    strlen($city) > 30 ||
    strlen($contact) > 15
) {
    $_SESSION['error'] = 'One or more fields are too long.';
    redirect("../views/register.php");
}

// Put the data into an array
$data = [
    'name' => $name,
    'email' => $email,
    'pass' => $pass,
    'country' => $country,
    'city' => $city,
    'contact' => $contact
];

// Create Controller
$controller = new CustomerController();

// Register customer
$result = $controller->register($data);

// Check result
if ($result['success']) {

    $_SESSION['user_role'] = 2;

    redirect("../index.php");

} else {

    $_SESSION['error'] = $result['error'];

    redirect("../views/register.php");
}

?>