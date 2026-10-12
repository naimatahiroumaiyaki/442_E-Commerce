<?php
require_once __DIR__ . "/../../core/core.php";

$base_url = "/~naima.maiyaki/ECommerce_Labs/shoppn";
?>

<style>
    .main-header {
        background: white;
        border-bottom: 1px solid #e5e7eb;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .main-nav {
        max-width: 1200px;
        margin: 0 auto;
        padding: 16px 25px;

        display: flex;
        align-items: center;
        gap: 25px;
    }

    .nav-logo {
        margin-right: auto;
        font-size: 22px;
        font-weight: 700;
        color: #111827;
        text-decoration: none;
    }

    .nav-logo span {
        color: #25d1eb;
    }

    .main-nav a {
        color: #374151;
        text-decoration: none;
        font-size: 15px;
        font-weight: 600;
        transition: 0.2s;
    }

    .main-nav a:hover {
        color: #25cdeb;
    }

    .welcome-user {
        color: #6b7280;
        font-size: 15px;
    }

    .logout-link {
        color: #dc2626 !important;
    }

    .logout-link:hover {
        color: #b91c1c !important;
    }

    .admin-link {
        color: #25dbeb !important;
    }

    @media (max-width: 700px) {

        .main-nav {
            flex-wrap: wrap;
            gap: 15px;
        }

        .nav-logo {
            width: 100%;
            margin-right: 0;
        }
    }
</style>


<header class="main-header">

    <nav class="main-nav">

        <a href="<?php echo $base_url; ?>/index.php"
           class="nav-logo">
            Ecom <span>LAB</span>
        </a>

        <a href="<?php echo $base_url; ?>/index.php">
            Home
        </a>


        <?php if (!is_logged_in()): ?>

            <a href="<?php echo $base_url; ?>/views/register.php">
                Register
            </a>

            <a href="<?php echo $base_url; ?>/views/login.php">
                Login
            </a>


        <?php else: ?>

            <span class="welcome-user">
                Ninja,
                <?php echo htmlspecialchars($_SESSION['customer_name']); ?>
            </span>

            <a href="<?php echo $base_url; ?>/views/account/my_account.php">
                My Account
            </a>


            <?php if (is_admin()): ?>

                <a class="admin-link"
                   href="<?php echo $base_url; ?>/views/admin/brand.php">
                    Add Brand
                </a>

                <a class="admin-link"
                   href="<?php echo $base_url; ?>/views/admin/category.php">
                    Add Category
                </a>

                <a class="admin-link"
                    href="<?php echo $base_url; ?>/views/admin/product.php">
                        Add Product
                </a>

                <a class="admin-link"
                    href="<?php echo $base_url; ?>/views/admin/product_list.php">
                        Product List
                </a>

            <?php endif; ?>


            <a class="logout-link"
               href="<?php echo $base_url; ?>/logout.php">
                Logout
            </a>

        <?php endif; ?>

    </nav>

</header>