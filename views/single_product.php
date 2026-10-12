<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controllers/ProductController.php';

$base_url = '/~naima.maiyaki/ECommerce_Labs/shoppn';

if (!isset($_GET['pro_id']) || !is_numeric($_GET['pro_id'])) {
    header("Location: " . $base_url . "/index.php");
    exit;
}

$product_id = (int) $_GET['pro_id'];

$controller = new ProductController();
$product = $controller->getProductById($product_id);

if (!$product) {
    http_response_code(404);
    $not_found = true;
} else {
    $not_found = false;
}

include __DIR__ . '/layout/header.php';
?>

<style>
.product-page {
    max-width: 1100px;
    margin: 55px auto;
    padding: 25px;
}

.product-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 55px;
    align-items: center;
}

.product-image {
    background: #f7f3ee;
    border-radius: 12px;
    padding: 30px;
    text-align: center;
}

.product-image img {
    width: 100%;
    max-width: 430px;
    height: 450px;
    object-fit: contain;
}

.product-details .brand {
    color: #96754d;
    text-transform: uppercase;
    letter-spacing: 3px;
    font-size: 13px;
}

.product-details h1 {
    font-size: 36px;
    margin: 15px 0;
    color: #241b16;
}

.product-price {
    font-size: 28px;
    color: #96754d;
    font-weight: bold;
    margin: 20px 0;
}

.product-description {
    line-height: 1.8;
    color: #666;
    margin: 20px 0;
}

.product-category {
    color: #777;
    margin-bottom: 20px;
}

.quantity-input {
    width: 75px;
    padding: 12px;
    margin: 15px 10px 20px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.add-cart-button {
    display: inline-block;
    padding: 14px 28px;
    background: #241b16;
    color: white;
    border: none;
    text-decoration: none;
    cursor: pointer;
    transition: 0.3s;
}

.add-cart-button:hover {
    background: #96754d;
}

.back-link {
    display: inline-block;
    margin-top: 30px;
    color: #96754d;
    text-decoration: none;
}

.not-found {
    text-align: center;
    padding: 100px 20px;
}

@media (max-width: 768px) {
    .product-container {
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .product-image img {
        height: 320px;
    }

    .product-details h1 {
        font-size: 28px;
    }
}
</style>

<main class="product-page">

<?php if ($not_found): ?>

    <div class="not-found">
        <h2>Perfume Not Found</h2>
        <p>Sorry, this perfume is unavailable or may have been removed.</p>
        <a class="back-link"
           href="<?= htmlspecialchars($base_url) ?>/index.php">
            Return to Home
        </a>
    </div>

<?php else: ?>

    <div class="product-container">

        <div class="product-image">
            <?php
            $image_name = basename($product['product_image'] ?? '');
            $image_path = __DIR__ . '/../images/products/' . $image_name;
            ?>

            <?php if ($image_name !== '' && is_file($image_path)): ?>
                <img
                    src="<?= htmlspecialchars($base_url) ?>/images/products/<?= rawurlencode($image_name) ?>"
                    alt="<?= htmlspecialchars($product['product_title']) ?>"
                >
            <?php else: ?>
                <p>Product image unavailable.</p>
            <?php endif; ?>
        </div>

        <div class="product-details">

            <p class="brand">
                <?= htmlspecialchars($product['brand_name'] ?? 'Perfume') ?>
            </p>

            <h1>
                <?= htmlspecialchars($product['product_title']) ?>
            </h1>

            <p class="product-category">
                Category:
                <?= htmlspecialchars($product['cat_name'] ?? 'Fragrance') ?>
            </p>

            <p class="product-price">
                GHS <?= number_format((float) $product['product_price'], 2) ?>
            </p>

            <div class="product-description">
                <?= nl2br(htmlspecialchars(
                    $product['product_desc'] ?? 'No description available.'
                )) ?>
            </div>

            <form method="GET"
                  action="<?= htmlspecialchars($base_url) ?>/index.php">

                <input type="hidden" name="add_cart"
                       value="<?= (int) $product['product_id'] ?>">

                <label for="quantity">Quantity:</label>

                <input
                    class="quantity-input"
                    type="number"
                    id="quantity"
                    name="quantity"
                    value="1"
                    min="1"
                    max="20"
                    required
                >

                <button type="submit" class="add-cart-button">
                    Add to Cart
                </button>

            </form>

            <a class="back-link"
               href="<?= htmlspecialchars($base_url) ?>/index.php">
                &larr; Continue Shopping
            </a>

        </div>

    </div>

<?php endif; ?>

</main>

<?php include __DIR__ . '/layout/footer.php'; ?>