<?php

require_once '../core/core.php';
require_admin();

require_once '../controllers/ProductController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../views/admin/brand.php');
}

$brand_id = $_POST['brand_id'] ?? '';
$brand_name = trim(strip_tags($_POST['brand_name'] ?? ''));

if (!ctype_digit($brand_id) || (int)$brand_id <= 0) {
    $_SESSION['error'] = 'Invalid brand ID.';
    redirect('../views/admin/brand.php');
}

if ($brand_name === '') {
    $_SESSION['error'] = 'Brand name is required.';
    redirect('../views/admin/brand.php');
}

$brand_id = (int)$brand_id;

$controller = new ProductController();

if ($controller->updateBrand($brand_id, $brand_name)) {
    $_SESSION['success'] = 'Brand updated.';
} else {
    $_SESSION['error'] = 'Failed to update brand.';
}

redirect('../views/admin/brand.php');
?>