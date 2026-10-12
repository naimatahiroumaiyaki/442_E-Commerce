<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controllers/ProductController.php';

$controller = new ProductController();

$base_url = '/~naima.maiyaki/ECommerce_Labs/shoppn';

$user_query = trim($_GET['user_query'] ?? '');

$products = [];

if ($user_query !== '') {
    $products = $controller->searchProducts($user_query);
}

require_once __DIR__ . '/layout/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Search Results | Maison de Senteur</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #faf7f2;
            color: #35231a;
            font-family: Arial, sans-serif;
        }

        .search-container {
            max-width: 1200px;
            min-height: 65vh;
            margin: auto;
            padding: 55px 25px;
        }

        .search-heading {
            text-align: center;
            margin-bottom: 35px;
        }

        .eyebrow {
            color: #a77d42;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 4px;
            text-transform: uppercase;
        }

        h1 {
            margin: 15px 0;
            font-family: Georgia, serif;
            font-size: 40px;
            font-weight: normal;
        }

        .search-heading p {
            color: #847367;
            line-height: 1.7;
        }

        .search-form {
            display: flex;
            max-width: 650px;
            margin: 25px auto 45px;
            background: white;
            border: 1px solid #e4d7c7;
        }

        .search-form input {
            flex: 1;
            min-width: 0;
            padding: 15px;
            border: none;
            outline: none;
            font-size: 14px;
        }

        .search-form button {
            padding: 0 22px;
            background: #39251a;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        .search-form button:hover {
            background: #9c713e;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 22px;
        }

        .product-card {
            overflow: hidden;
            background: white;
            border: 1px solid #eee5da;
        }

        .product-image-wrap {
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0e8dc;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 15px;
        }

        .no-image {
            color: #8e7762;
            font-size: 13px;
        }

        .product-info {
            padding: 18px;
        }

        .product-brand {
            color: #a77d42;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .product-title {
            min-height: 42px;
            font-family: Georgia, serif;
            font-size: 18px;
            font-weight: normal;
        }

        .product-price {
            margin-bottom: 18px;
            font-weight: bold;
        }

        .product-actions {
            display: flex;
            gap: 8px;
        }

        .product-actions a {
            flex: 1;
            padding: 11px 6px;
            text-align: center;
            font-size: 11px;
            font-weight: bold;
            text-decoration: none;
        }

        .details {
            color: #533a29;
            border: 1px solid #cdb99f;
        }

        .cart {
            color: white;
            background: #39251a;
        }

        .empty-results {
            padding: 45px 20px;
            text-align: center;
            background: white;
            border: 1px solid #eee5da;
        }

        .empty-results h2 {
            font-family: Georgia, serif;
            font-weight: normal;
        }

        .empty-results p {
            color: #847367;
            line-height: 1.7;
        }

        .back-home {
            display: inline-block;
            margin-top: 15px;
            padding: 12px 20px;
            background: #39251a;
            color: white;
            text-decoration: none;
        }

        @media (max-width: 850px) {
            .product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 32px;
            }

            .search-container {
                padding: 35px 15px;
            }

            .product-image-wrap {
                height: 190px;
            }

            .product-info {
                padding: 12px;
            }
        }
    </style>
</head>

<body>

<main class="search-container">

    <div class="search-heading">

        <div class="eyebrow">Find Your Fragrance</div>

        <h1>Search Results</h1>

        <?php if ($user_query !== ''): ?>

            <p>
                Results for:
                <strong>
                    <?php echo htmlspecialchars($user_query); ?>
                </strong>
            </p>

        <?php else: ?>

            <p>Search for a perfume, brand or fragrance.</p>

        <?php endif; ?>

    </div>

    <form
        class="search-form"
        method="GET"
        action="<?php echo $base_url; ?>/views/search_results.php"
    >

        <input
            type="search"
            name="user_query"
            value="<?php echo htmlspecialchars($user_query); ?>"
            placeholder="Search perfumes or brands..."
            required
        >

        <button type="submit">Search</button>

    </form>

    <div class="product-grid">

        <?php if ($user_query === ''): ?>

            <div class="empty-results" style="grid-column: 1 / -1;">

                <h2>What fragrance are you looking for?</h2>

                <p>Enter a perfume name or keyword in the search box.</p>

            </div>

        <?php elseif (!empty($products)): ?>

            <?php foreach ($products as $product): ?>

                <?php
                $id = (int) ($product['product_id'] ?? 0);
                $title = $product['product_title'] ?? 'Perfume';
                $brand = $product['brand_name'] ?? '';
                $price = (float) ($product['product_price'] ?? 0);
                $image = $product['product_image'] ?? '';
                ?>

                <article class="product-card">

                    <a href="<?php echo $base_url; ?>/views/single_product.php?pro_id=<?php echo $id; ?>">

                        <div class="product-image-wrap">

                            <?php if ($image !== ''): ?>

                                <img
                                    class="product-image"
                                    src="<?php echo htmlspecialchars(
                                        $base_url . '/images/products/' .
                                        implode('/', array_map(
                                            'rawurlencode',
                                            explode('/', ltrim(str_replace('\\', '/', $image), '/'))
                                        ))
                                    ); ?>"
                                    alt="<?php echo htmlspecialchars($title); ?>"
                                    onerror="this.style.display='none';"
                                >

                            <?php else: ?>

                                <span class="no-image">No image available</span>

                            <?php endif; ?>

                        </div>

                    </a>

                    <div class="product-info">

                        <?php if ($brand !== ''): ?>

                            <div class="product-brand">
                                <?php echo htmlspecialchars($brand); ?>
                            </div>

                        <?php endif; ?>

                        <h2 class="product-title">
                            <?php echo htmlspecialchars($title); ?>
                        </h2>

                        <div class="product-price">
                            GHS <?php echo number_format($price, 2); ?>
                        </div>

                        <div class="product-actions">

                            <a
                                class="details"
                                href="<?php echo $base_url; ?>/views/single_product.php?pro_id=<?php echo $id; ?>"
                            >
                                Details
                            </a>

                            <a
                                class="cart"
                                href="<?php echo $base_url; ?>/index.php?add_cart=<?php echo $id; ?>"
                            >
                                Add to Cart
                            </a>

                        </div>

                    </div>

                </article>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="empty-results" style="grid-column: 1 / -1;">

                <h2>No perfumes found</h2>

                <p>
                    We couldn't find any products matching
                    "<?php echo htmlspecialchars($user_query); ?>".
                    Try another perfume name or keyword.
                </p>

                <a
                    class="back-home"
                    href="<?php echo $base_url; ?>/index.php#collection"
                >
                    Browse Collection
                </a>

            </div>

        <?php endif; ?>

    </div>

</main>

</body>
</html>