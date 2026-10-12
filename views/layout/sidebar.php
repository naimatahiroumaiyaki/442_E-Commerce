<?php
require_once __DIR__ . '/../../core/core.php';
require_once __DIR__ . '/../../controllers/ProductController.php';

$controller = new ProductController();

$categories = $controller->getAllCategories();
$brands = $controller->getAllBrands();

$base_url = '/~naima.maiyaki/ECommerce_Labs/shoppn';
?>

<style>
    .shop-sidebar {
        background: #ffffff;
        padding: 25px;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        margin-bottom: 25px;
    }

    .shop-sidebar h3 {
        font-size: 20px;
        color: #25201d;
        margin: 0 0 15px;
    }

    .shop-sidebar ul {
        list-style: none;
        padding: 0;
        margin: 0 0 25px;
    }

    .shop-sidebar li {
        margin-bottom: 12px;
    }

    .shop-sidebar a {
        color: #5b5148;
        text-decoration: none;
        transition: color 0.2s;
    }

    .shop-sidebar a:hover {
        color: #b28a4b;
    }

    .shop-sidebar .sidebar-all {
        font-weight: bold;
        color: #a47b3c;
    }
</style>

<aside class="shop-sidebar">

    <h3>Categories</h3>

    <ul>
        <li>
            <a class="sidebar-all"
               href="<?php echo $base_url; ?>/index.php">
                All Perfumes
            </a>
        </li>

        <?php foreach ($categories as $category): ?>
            <li>
                <a href="<?php echo $base_url; ?>/index.php?cat=<?php echo (int)$category['cat_id']; ?>">
                    <?php echo htmlspecialchars($category['cat_name']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <h3>Brands</h3>

    <ul>
        <li>
            <a class="sidebar-all"
               href="<?php echo $base_url; ?>/index.php">
                All Brands
            </a>
        </li>

        <?php foreach ($brands as $brand): ?>
            <li>
                <a href="<?php echo $base_url; ?>/index.php?brand=<?php echo (int)$brand['brand_id']; ?>">
                    <?php echo htmlspecialchars($brand['brand_name']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

</aside>