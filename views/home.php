<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controllers/ProductController.php';

$controller = new ProductController();

/*
|--------------------------------------------------------------------------
| Load products
|--------------------------------------------------------------------------
| Category selected: get products by category.
| Brand selected: get products by brand.
| Otherwise: show featured products.
*/

if (isset($_GET['cat']) && is_numeric($_GET['cat'])) {
    $products = $controller->getProductsByCategory((int) $_GET['cat']);
} elseif (isset($_GET['brand']) && is_numeric($_GET['brand'])) {
    $products = $controller->getProductsByBrand((int) $_GET['brand']);
} else {
    $products = $controller->getFeaturedProducts(8);
}

$base_url = '/~naima.maiyaki/ECommerce_Labs/shoppn';

/*
|--------------------------------------------------------------------------
| Helper for displaying product images
|--------------------------------------------------------------------------
*/

function perfumeImageUrl($filename, $base_url)
{
    if (empty($filename)) {
        return '';
    }

    // Support filenames that may already contain a relative directory.
    $filename = str_replace('\\', '/', $filename);
    $filename = ltrim($filename, '/');

    return $base_url . '/images/products/' .
        implode('/', array_map('rawurlencode', explode('/', $filename)));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Maison de Senteur | Discover Your Signature Scent</title>

    <meta
        name="description"
        content="Discover captivating fragrances, elegant perfumes and unforgettable scents."
    >

    <style>
        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #faf7f2;
            color: #2a1b16;
        }

        a {
            text-decoration: none;
        }

        /* =====================================
           LUXURY HERO SECTION
        ===================================== */

        .hero {
            background-image:
                linear-gradient(
                    to right,
                    rgba(25, 10, 5, 0.45),
                    rgba(25, 10, 5, 0.10)
                ),
                url('/~naima.maiyaki/ECommerce_Labs/shoppn/assets/images/perfume-background.png');

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 650px;
            display: flex;
            align-items: center;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1250px;
            margin: 0 auto;
            padding: 95px 55px;
        }

        .hero-eyebrow {
            color: #d9b36e;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 6px;
            text-transform: uppercase;
            margin-bottom: 27px;
        }

        .hero-content h1 {
            max-width: 760px;
            color: #fffaf4;
            font-family: Georgia, 'Times New Roman', serif;
            font-size: clamp(48px, 6.5vw, 88px);
            line-height: 1.04;
            font-weight: 400;
            margin: 0 0 27px;
        }

        .hero-content h1 span {
            display: block;
            color: #d9b36e;
            font-style: italic;
            margin-top: 8px;
        }

        .hero-description {
            max-width: 570px;
            color: #a27647;
            font-size: 17px;
            line-height: 1.9;
            margin: 0 0 34px;
        }

        .hero-button {
            display: inline-block;
            padding: 18px 31px;
            background: #d2ad70;
            color: #21130d;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            transition: 0.3s ease;
        }

        .hero-button:hover {
            background: #f0d39b;
            transform: translateY(-2px);
        }

        .hero-note {
            color: #7b5c3b;
            font-size: 12px;
            letter-spacing: 2px;
            margin-top: 27px;
            text-transform: uppercase;
        }

        /* =====================================
           BENEFITS STRIP
        ===================================== */

        .benefits {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            background: #fffdf9;
            border-bottom: 1px solid #e9dfd1;
        }

        .benefit {
            padding: 27px 15px;
            text-align: center;
            border-right: 1px solid #e9dfd1;
        }

        .benefit:last-child {
            border-right: none;
        }

        .benefit strong {
            display: block;
            color: #553a29;
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 17px;
            font-weight: 400;
            margin-bottom: 7px;
        }

        .benefit span {
            color: #887667;
            font-size: 12px;
        }

        /* =====================================
           MAIN CONTENT
        ===================================== */

        .page-container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 75px 35px;
        }

        .section-heading {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-eyebrow {
            color: #a77d42;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            margin-bottom: 14px;
        }

        .section-heading h2 {
            color: #2d1b14;
            font-family: Georgia, 'Times New Roman', serif;
            font-size: clamp(32px, 4vw, 46px);
            font-weight: 400;
            margin: 0 0 14px;
        }

        .section-heading p {
            color: #847367;
            font-size: 15px;
            line-height: 1.7;
            margin: 0;
        }

        /* =====================================
           SEARCH BAR
        ===================================== */

        .search-section {
            max-width: 680px;
            margin: 0 auto 65px;
        }

        .search-form {
            display: flex;
            width: 100%;
            background: white;
            border: 1px solid #e4d7c7;
        }

        .search-form input {
            flex: 1;
            min-width: 0;
            padding: 17px 20px;
            border: none;
            outline: none;
            background: transparent;
            color: #35231a;
            font-size: 14px;
        }

        .search-form button {
            padding: 0 25px;
            border: none;
            background: #3b261b;
            color: white;
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .search-form button:hover {
            background: #9c713e;
        }

        /* =====================================
           PRODUCT GRID
        ===================================== */

        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 25px;
        }

        .product-card {
            min-width: 0;
            overflow: hidden;
            background: #fffdf9;
            border: 1px solid #eee5da;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(54, 35, 23, 0.10);
        }

        .product-image-wrap {
            position: relative;
            height: 280px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: #f0e8dc;
        }

        .product-image {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: contain;
            padding: 18px;
            transition: transform 0.4s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.04);
        }

        .image-placeholder {
            color: #8e7762;
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 15px;
            text-align: center;
            padding: 20px;
        }

        .product-info {
            padding: 22px 19px 23px;
        }

        .product-brand {
            color: #a77d42;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .product-title {
            min-height: 45px;
            color: #35231a;
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 19px;
            font-weight: 400;
            line-height: 1.4;
            margin: 0 0 12px;
        }

        .product-price {
            color: #68472b;
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 19px;
        }

        .product-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .product-button {
            display: inline-block;
            flex: 1;
            padding: 12px 9px;
            text-align: center;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: 0.2s ease;
        }

        .details-button {
            color: #533a29;
            border: 1px solid #cdb99f;
        }

        .details-button:hover {
            background: #f1e5d4;
        }

        .cart-button {
            color: white;
            background: #39251a;
            border: 1px solid #39251a;
        }

        .cart-button:hover {
            background: #9c713e;
            border-color: #9c713e;
        }

        .empty-products {
            grid-column: 1 / -1;
            padding: 50px 20px;
            text-align: center;
            background: #fffdf9;
            border: 1px solid #eee5da;
        }

        .empty-products h3 {
            color: #35231a;
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 25px;
            font-weight: 400;
        }

        .empty-products p {
            color: #847367;
            line-height: 1.7;
        }

        /* =====================================
           BOTTOM BANNER
        ===================================== */

        .brand-banner {
            position: relative;
            overflow: hidden;
            background: #2b1912;
            color: white;
            text-align: center;
            padding: 65px 25px;
        }

        .brand-banner .section-eyebrow {
            color: #d9b36e;
        }

        .brand-banner h2 {
            font-family: Georgia, 'Times New Roman', serif;
            font-size: clamp(30px, 4vw, 43px);
            font-weight: 400;
            margin: 0 0 15px;
        }

        .brand-banner p {
            max-width: 600px;
            margin: 0 auto 28px;
            color: #e2d2c2;
            font-size: 15px;
            line-height: 1.8;
        }

        .brand-banner a {
            display: inline-block;
            padding: 15px 26px;
            background: #d2ad70;
            color: #21130d;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .brand-banner a:hover {
            background: #f0d39b;
        }

        /* =====================================
           FOOTER
        ===================================== */

        .site-footer {
            background: #1b100c;
            color: #e9dbcb;
            text-align: center;
            padding: 27px 15px;
            font-size: 12px;
            line-height: 1.8;
        }

        .site-footer strong {
            color: #d9b36e;
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 17px;
            font-weight: 400;
        }

        /* =====================================
           RESPONSIVE DESIGN
        ===================================== */

        @media (max-width: 1000px) {
            .product-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .hero-content {
                padding-left: 35px;
                padding-right: 35px;
            }
        }

        @media (max-width: 700px) {
            .perfume-hero {
                min-height: 600px;
                background-position: 62% center;
            }

            .hero-content {
                padding: 75px 24px;
            }

            .hero-eyebrow {
                font-size: 10px;
                letter-spacing: 4px;
            }

            .hero-content h1 {
                font-size: 48px;
            }

            .hero-description {
                font-size: 15px;
            }

            .benefit {
                padding: 22px 8px;
            }

            .benefit strong {
                font-size: 14px;
            }

            .benefit span {
                font-size: 10px;
            }

            .page-container {
                padding: 55px 18px;
            }

            .product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 13px;
            }

            .product-image-wrap {
                height: 210px;
            }

            .product-info {
                padding: 16px 12px;
            }

            .product-title {
                font-size: 16px;
            }

            .product-button {
                font-size: 10px;
            }

            .search-form input {
                padding: 15px 12px;
                font-size: 12px;
            }

            .search-form button {
                padding: 0 14px;
                font-size: 10px;
            }
        }

        @media (max-width: 380px) {
            .hero-content h1 {
                font-size: 40px;
            }

            .product-grid {
                grid-template-columns: 1fr;
            }

            .product-image-wrap {
                height: 260px;
            }
        }
    </style>
</head>

<body>

<?php require_once __DIR__ . '/layout/header.php'; ?>

<!-- =====================================
     HERO
===================================== -->

<section class="perfume-hero">

    <div class="hero-content">

        <div class="hero-eyebrow">
            The Art of Fragrance
        </div>

        <h1>
            Discover Your
            <span>Signature Scent</span>
        </h1>

        <p class="hero-description">
            Explore a world of captivating fragrances, rich oud,
            elegant perfumes, and unforgettable scents chosen
            to express your individuality.
        </p>

        <a href="#collection" class="hero-button">
            Discover Our Collection
        </a>

        <div class="hero-note">
            Fragrance · Elegance · Identity
        </div>

    </div>

</section>

<!-- =====================================
     BENEFITS
===================================== -->

<section class="benefits">

    <div class="benefit">
        <strong>Discover Your Scent</strong>
        <span>Find a fragrance that feels like you.</span>
    </div>

    <div class="benefit">
        <strong>Explore Beautiful Fragrances</strong>
        <span>From rich oud to elegant everyday scents.</span>
    </div>

    <div class="benefit">
        <strong>Express Your Identity</strong>
        <span>Make every impression memorable.</span>
    </div>

</section>

<!-- =====================================
     PRODUCT COLLECTION
===================================== -->

<main class="page-container" id="collection">

    <div class="section-heading">

        <div class="section-eyebrow">
            The Fragrance Collection
        </div>

        <h2>Find Your Next Favourite</h2>

        <p>
            Explore our collection and discover a fragrance
            that matches your personality.
        </p>

    </div>

    <!-- Search submits directly to the search results view. -->
    <div class="search-section">

        <form
            class="search-form"
            method="GET"
            action="<?php echo $base_url; ?>/views/search_results.php"
        >

            <input
                type="search"
                name="user_query"
                placeholder="Search perfumes, brands or fragrances..."
                aria-label="Search perfumes"
                required
            >

            <button type="submit">
                Search
            </button>

        </form>

    </div>

    <div class="product-grid">

        <?php if (!empty($products)): ?>

            <?php foreach ($products as $product): ?>

                <?php
                $productId = (int) ($product['product_id'] ?? 0);
                $productTitle = $product['product_title'] ?? 'Perfume';
                $productBrand = $product['brand_name'] ?? '';
                $productPrice = (float) ($product['product_price'] ?? 0);
                $productImage = $product['product_image'] ?? '';
                ?>

                <article class="product-card">

                    <a
                        href="<?php echo $base_url; ?>/views/single_product.php?pro_id=<?php echo $productId; ?>"
                        aria-label="View <?php echo htmlspecialchars($productTitle); ?>"
                    >

                        <div class="product-image-wrap">

                            <?php if (!empty($productImage)): ?>

                                <img
                                    class="product-image"
                                    src="<?php echo htmlspecialchars(perfumeImageUrl($productImage, $base_url)); ?>"
                                    alt="<?php echo htmlspecialchars($productTitle); ?>"
                                    loading="lazy"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                                >

                                <div
                                    class="image-placeholder"
                                    style="display:none;"
                                >
                                    Perfume image unavailable
                                </div>

                            <?php else: ?>

                                <div class="image-placeholder">
                                    Perfume image unavailable
                                </div>

                            <?php endif; ?>

                        </div>

                    </a>

                    <div class="product-info">

                        <?php if (!empty($productBrand)): ?>

                            <div class="product-brand">
                                <?php echo htmlspecialchars($productBrand); ?>
                            </div>

                        <?php else: ?>

                            <div class="product-brand">
                                Discover the fragrance
                            </div>

                        <?php endif; ?>

                        <h3 class="product-title">
                            <?php echo htmlspecialchars($productTitle); ?>
                        </h3>

                        <div class="product-price">
                            GHS <?php echo number_format($productPrice, 2); ?>
                        </div>

                        <div class="product-actions">

                            <a
                                class="product-button details-button"
                                href="<?php echo $base_url; ?>/views/single_product.php?pro_id=<?php echo $productId; ?>"
                            >
                                Details
                            </a>

                            <a
                                class="product-button cart-button"
                                href="<?php echo $base_url; ?>/index.php?add_cart=<?php echo $productId; ?>"
                            >
                                Add to Cart
                            </a>

                        </div>

                    </div>

                </article>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="empty-products">

                <h3>Your next favourite fragrance awaits.</h3>

                <p>
                    There are no products to display in this collection yet.
                    Please check back when products have been added.
                </p>

            </div>

        <?php endif; ?>

    </div>

</main>

<!-- =====================================
     BRAND BANNER
===================================== -->

<section class="brand-banner">

    <div class="section-eyebrow">
        Your Fragrance Journey
    </div>

    <h2>A Scent That Speaks Without Words</h2>

    <p>
        Some fragrances make an impression.
        Others become part of your identity.
        Discover the scent that tells your story.
    </p>

    <a href="#collection">
        Explore the Collection
    </a>

</section>

<!-- =====================================
     FOOTER
===================================== -->

<footer class="site-footer">

    <strong>Maison de Senteur</strong>

    <div>
        Discover your signature scent.
    </div>

    <div>
        &copy; <?php echo date('Y'); ?> Maison de Senteur.
        All rights reserved.
    </div>

</footer>

</body>
</html>