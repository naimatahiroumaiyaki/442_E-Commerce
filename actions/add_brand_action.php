<?php
require_once '../core/core.php';
require_admin();

require_once '../controllers/ProductController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../views/admin/brand.php');
}

$name = trim(strip_tags($_POST['brand_name'] ?? ''));

if ($name === '') {
    $_SESSION['error'] = 'Brand name is required.';
    redirect('../views/admin/brand.php');
}

$controller = new ProductController();

if ($controller->addBrand($name)) {
    $_SESSION['success'] = 'Brand added.';
} else {
    $_SESSION['error'] = 'Failed to add brand.';
}

redirect('../views/admin/brand.php');
?>