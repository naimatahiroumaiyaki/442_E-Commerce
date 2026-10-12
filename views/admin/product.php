<?php
require_once __DIR__ . '/../../core/core.php';
require_admin();

require_once __DIR__ . '/../../controllers/ProductController.php';

$controller = new ProductController();

$categories = $controller->getAllCategories();
$brands = $controller->getAllBrands();

$product = null;
$isEditing = false;

if (isset($_GET['edit_id']) && ctype_digit($_GET['edit_id'])) {
    $product = $controller->getProductById((int) $_GET['edit_id']);

    if ($product) {
        $isEditing = true;
    }
}

function productEscape($value)
{
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Product Management</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 750px;
            margin: 35px auto;
            padding: 25px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
            color: #222;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        button {
            margin-top: 20px;
            padding: 12px 20px;
            background: #222;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #444;
        }

        .current-image {
            max-width: 150px;
            display: block;
            margin-top: 10px;
        }

        .message {
            padding: 10px;
            margin-bottom: 15px;
            background: #eef5ee;
            border-radius: 4px;
        }
    </style>
</head>

<body>

<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container">

    <h2>
        <?= $isEditing ? 'Edit Product' : 'Add New Product' ?>
    </h2>

    <?php if (!empty($_SESSION['success'])): ?>
        <div class="message">
            <?= productEscape($_SESSION['success']) ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="message">
            <?= productEscape($_SESSION['error']) ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form
        action="<?= $isEditing
            ? '../../actions/update_product_action.php'
            : '../../actions/add_product_action.php' ?>"
        method="POST"
        enctype="multipart/form-data"
    >

        <?php if ($isEditing): ?>
            <input
                type="hidden"
                name="product_id"
                value="<?= productEscape($product['product_id']) ?>"
            >
        <?php endif; ?>

        <label for="product_title">Product Name</label>
        <input
            type="text"
            id="product_title"
            name="product_title"
            value="<?= productEscape($product['product_title'] ?? '') ?>"
            required
        >

        <label for="product_cat">Category</label>
        <select id="product_cat" name="product_cat" required>
            <option value="">Select Category</option>

            <?php foreach ($categories as $category): ?>
                <option
                    value="<?= productEscape($category['cat_id']) ?>"
                    <?= isset($product['product_cat']) &&
                        $product['product_cat'] == $category['cat_id']
                        ? 'selected' : '' ?>
                >
                    <?= productEscape($category['cat_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="product_brand">Brand</label>
        <select id="product_brand" name="product_brand" required>
            <option value="">Select Brand</option>

            <?php foreach ($brands as $brand): ?>
                <option
                    value="<?= productEscape($brand['brand_id']) ?>"
                    <?= isset($product['product_brand']) &&
                        $product['product_brand'] == $brand['brand_id']
                        ? 'selected' : '' ?>
                >
                    <?= productEscape($brand['brand_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="product_price">Price</label>
        <input
            type="number"
            id="product_price"
            name="product_price"
            min="0"
            step="0.01"
            value="<?= productEscape($product['product_price'] ?? '') ?>"
            required
        >

        <label for="product_desc">Description</label>
        <textarea
            id="product_desc"
            name="product_desc"
            required
        ><?= productEscape($product['product_desc'] ?? '') ?></textarea>

        <label for="product_keywords">Keywords</label>
        <input
            type="text"
            id="product_keywords"
            name="product_keywords"
            value="<?= productEscape($product['product_keywords'] ?? '') ?>"
            required
        >

        <label for="product_image">
            Product Image <?= $isEditing ? '(Optional)' : '' ?>
        </label>

        <input
            type="file"
            id="product_image"
            name="product_image"
            accept="image/jpeg,image/png,image/gif,image/webp"
            <?= $isEditing ? '' : 'required' ?>
        >

        <?php if ($isEditing && !empty($product['product_image'])): ?>
            <p>Current image:</p>

            <img
                class="current-image"
                src="../../images/products/<?= rawurlencode(basename($product['product_image'])) ?>"
                alt="Current product image"
            >
        <?php endif; ?>

        <button type="submit">
            <?= $isEditing ? 'Update Product' : 'Add Product' ?>
        </button>

    </form>

</div>

</body>
</html>