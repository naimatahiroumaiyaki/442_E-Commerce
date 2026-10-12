<?php

require_once __DIR__ . '/../core/core.php';
require_admin();

require_once __DIR__ . '/../controllers/ProductController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../views/admin/category.php');
}

$category_id = $_POST['cat_id'] ?? '';

if (!ctype_digit((string)$category_id) || (int)$category_id <= 0) {
    $_SESSION['error'] = 'Invalid category selected.';
    redirect('../views/admin/category.php');
}

$controller = new ProductController();

$success = $controller->deleteCategory((int)$category_id);

if ($success) {
    $_SESSION['success'] = 'Category deleted successfully.';
} else {
    $_SESSION['error'] = 'Unable to delete category. It may be linked to existing products.';
}

redirect('../views/admin/category.php');

?>