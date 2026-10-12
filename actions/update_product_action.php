<?php
require_once __DIR__ . '/../core/core.php';
require_admin();

require_once __DIR__ . '/../controllers/ProductController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../views/admin/product.php');
}

// Get product ID and form data
$id = $_POST['product_id'] ?? '';
$cat = $_POST['product_cat'] ?? '';
$brand = $_POST['product_brand'] ?? '';
$title = trim(strip_tags($_POST['product_title'] ?? ''));
$price = $_POST['product_price'] ?? '';
$desc = trim(strip_tags($_POST['product_desc'] ?? ''));
$keywords = trim(strip_tags($_POST['product_keywords'] ?? ''));

// Validate product ID
if (!ctype_digit((string)$id) || (int)$id <= 0) {
    $_SESSION['error'] = 'Invalid product ID.';
    redirect('../views/admin/product.php');
}

$id = (int)$id;

// Retrieve the existing product
$controller = new ProductController();
$product = $controller->getProductById($id);

if (!$product) {
    $_SESSION['error'] = 'Product not found.';
    redirect('../views/admin/product.php');
}

// Validate form fields
if (
    !ctype_digit((string)$cat) || (int)$cat <= 0 ||
    !ctype_digit((string)$brand) || (int)$brand <= 0 ||
    $title === '' ||
    !is_numeric($price) || (float)$price < 0 ||
    $desc === '' ||
    $keywords === ''
) {
    $_SESSION['error'] = 'Please enter valid information in all fields.';
    redirect('../views/admin/product.php?edit_id=' . $id);
}

// Keep the existing image unless a new one is uploaded
$filename = $product['product_image'];
$image_directory = __DIR__ . '/../images/products/';

if (
    isset($_FILES['product_image']) &&
    $_FILES['product_image']['error'] !== UPLOAD_ERR_NO_FILE
) {
    // Check for upload errors
    if ($_FILES['product_image']['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['error'] = 'Image upload failed. Please try again.';
        redirect('../views/admin/product.php?edit_id=' . $id);
    }

    // Validate image type
    $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $file_type = $finfo->file($_FILES['product_image']['tmp_name']);

    if (!in_array($file_type, $allowed, true)) {
        $_SESSION['error'] = 'Only JPG, PNG, GIF, and WEBP images are allowed.';
        redirect('../views/admin/product.php?edit_id=' . $id);
    }

    // Validate image size (maximum 2 MB)
    if ($_FILES['product_image']['size'] > 2 * 1024 * 1024) {
        $_SESSION['error'] = 'The image must not exceed 2 MB.';
        redirect('../views/admin/product.php?edit_id=' . $id);
    }

    // Generate a unique filename
    $extension = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',
        'image/webp' => 'webp'
    ][$file_type];

    $new_filename = bin2hex(random_bytes(16)) . '.' . $extension;

    // Check that the image folder exists
    if (!is_dir($image_directory)) {
        $_SESSION['error'] = 'The product image folder does not exist.';
        redirect('../views/admin/product.php?edit_id=' . $id);
    }

    // Upload the new image
    if (!move_uploaded_file(
        $_FILES['product_image']['tmp_name'],
        $image_directory . $new_filename
    )) {
        $_SESSION['error'] = 'Image upload failed. Please try again.';
        redirect('../views/admin/product.php?edit_id=' . $id);
    }

    $filename = $new_filename;
}

// Update product information
$success = $controller->updateProduct(
    $id,
    (int)$cat,
    (int)$brand,
    $title,
    (float)$price,
    $desc,
    $filename,
    $keywords
);

if ($success) {
    // Remove the previous image if a new image replaced it
    if (
        $filename !== $product['product_image'] &&
        !empty($product['product_image'])
    ) {
        $old_image = $image_directory . basename($product['product_image']);

        if (is_file($old_image)) {
            unlink($old_image);
        }
    }

    $_SESSION['success'] = 'Product updated successfully.';
    redirect('../views/admin/product.php');
} else {
    // Remove the newly uploaded image if the database update failed
    if ($filename !== $product['product_image']) {
        $new_image = $image_directory . basename($filename);

        if (is_file($new_image)) {
            unlink($new_image);
        }
    }

    $_SESSION['error'] = 'Failed to update product.';
    redirect('../views/admin/product.php?edit_id=' . $id);
}
?>