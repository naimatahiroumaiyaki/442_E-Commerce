<?php

require_once '../core/core.php';
require_admin();

require_once '../controllers/ProductController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../views/admin/category.php');
}

$cat_id = $_POST['cat_id'] ?? '';
$cat_name = trim(strip_tags($_POST['cat_name'] ?? ''));

if (!ctype_digit($cat_id) || (int)$cat_id <= 0) {
    $_SESSION['error'] = 'Invalid category ID.';
    redirect('../views/admin/category.php');
}

if ($cat_name === '') {
    $_SESSION['error'] = 'Category name is required.';
    redirect('../views/admin/category.php');
}

$cat_id = (int)$cat_id;

$controller = new ProductController();

if ($controller->updateCategory($cat_id, $cat_name)) {
    $_SESSION['success'] = 'Category updated.';
} else {
    $_SESSION['error'] = 'Failed to update category.';
}

redirect('../views/admin/category.php');
?>