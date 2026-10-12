<?php

require_once __DIR__ . '/../core/core.php';
require_admin();

require_once __DIR__ . '/../controllers/ProductController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../views/admin/brand.php');
}

$name = trim($_POST['brand_name'] ?? '');

if ($name === '') {
    $_SESSION['error'] = 'Please enter a brand name.';
    redirect('../views/admin/brand.php');
}

$controller = new ProductController();

$success = $controller->addBrand($name);

if ($success) {
    $_SESSION['success'] = 'Brand added successfully!';
} else {
    $_SESSION['error'] = 'Unable to add the brand. Please try again.';
}

redirect('../views/admin/brand.php');
?>