<?php

require_once __DIR__ . '/../core/core.php';
require_admin();

require_once __DIR__ . '/../controllers/ProductController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../views/admin/brand.php');
}

$brand_id = $_POST['brand_id'] ?? '';

if (!ctype_digit((string)$brand_id) || (int)$brand_id <= 0) {
    $_SESSION['error'] = 'Invalid brand selected.';
    redirect('../views/admin/brand.php');
}

$controller = new ProductController();

$success = $controller->deleteBrand((int)$brand_id);

if ($success) {
    $_SESSION['success'] = 'Brand deleted successfully.';
} else {
    $_SESSION['error'] = 'Unable to delete brand. It may be linked to existing products.';
}

redirect('../views/admin/brand.php');

?>