<?php

require_once __DIR__ . '/../core/core.php';

require_admin();

require_once __DIR__ . '/../controllers/ProductController.php';

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../views/admin/product.php');
    exit();
}

// Get form data
$cat = $_POST['product_cat'] ?? '';
$brand = $_POST['product_brand'] ?? '';
$title = trim(strip_tags($_POST['product_title'] ?? ''));
$price = $_POST['product_price'] ?? '';
$desc = trim(strip_tags($_POST['product_desc'] ?? ''));
$keywords = trim(strip_tags($_POST['product_keywords'] ?? ''));

// Validate required fields
if (
    !ctype_digit((string) $cat) || (int) $cat < 1 ||
    !ctype_digit((string) $brand) || (int) $brand < 1 ||
    $title === '' ||
    $desc === '' ||
    $keywords === '' ||
    !is_numeric($price) ||
    (float) $price < 0
) {
    $_SESSION['error'] = 'Please provide valid information for all product fields.';
    header('Location: ../views/admin/product.php');
    exit();
}

// Check image upload
if (
    !isset($_FILES['product_image']) ||
    $_FILES['product_image']['error'] !== UPLOAD_ERR_OK
) {
    $_SESSION['error'] = 'Please select a product image.';
    header('Location: ../views/admin/product.php');
    exit();
}

$image = $_FILES['product_image'];

// Check image size (maximum 2 MB)
if ($image['size'] > 2 * 1024 * 1024) {
    $_SESSION['error'] = 'The image must not exceed 2 MB.';
    header('Location: ../views/admin/product.php');
    exit();
}

// Validate image type
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($image['tmp_name']);

$allowedTypes = [
    'image/jpeg' => 'jpg',
    'image/png'  => 'png',
    'image/gif'  => 'gif',
    'image/webp' => 'webp'
];

if (!isset($allowedTypes[$mime])) {
    $_SESSION['error'] = 'Please upload a valid JPEG, PNG, GIF, or WebP image.';
    header('Location: ../views/admin/product.php');
    exit();
}

// Generate a unique image filename
$filename = bin2hex(random_bytes(16)) . '.' . $allowedTypes[$mime];

// Image upload directory
$imageDirectory = __DIR__ . '/../images/products/';

// Check whether the directory exists
if (!is_dir($imageDirectory)) {
    $_SESSION['error'] = 'The product image directory does not exist.';
    header('Location: ../views/admin/product.php');
    exit();
}

// Move uploaded image
if (!move_uploaded_file($image['tmp_name'], $imageDirectory . $filename)) {
    $_SESSION['error'] = 'Image upload failed. Please try again.';
    header('Location: ../views/admin/product.php');
    exit();
}

// Save product to database
$controller = new ProductController();

$success = $controller->addProduct(
    (int) $cat,
    (int) $brand,
    $title,
    (float) $price,
    $desc,
    $filename,
    $keywords
);

if ($success) {
    $_SESSION['success'] = 'Product added successfully!';
} else {
    // Remove uploaded image if the database insert fails
    if (is_file($imageDirectory . $filename)) {
        unlink($imageDirectory . $filename);
    }

    $_SESSION['error'] = 'Unable to add the product. Please try again.';
}

header('Location: ../views/admin/product.php');
exit();
?>