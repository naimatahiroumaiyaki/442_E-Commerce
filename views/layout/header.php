<?php
require_once __DIR__ . "/../../core/core.php";

$base_url = "/~naima.maiyaki/ECommerce_Labs/shoppn";
?>

<header>

    <nav>

        <a href="<?php echo $base_url; ?>/index.php">Home</a>

        <?php if (!is_logged_in()): ?>

            <a href="<?php echo $base_url; ?>/views/register.php">Register</a>
            <a href="<?php echo $base_url; ?>/views/login.php">Login</a>

        <?php else: ?>

            <span>
                Welcome <?php echo htmlspecialchars($_SESSION['customer_name']); ?>
            </span>

            <a href="<?php echo $base_url; ?>/views/account/my_account.php">
                My Account
            </a>

            <a href="<?php echo $base_url; ?>/logout.php">
                Logout
            </a>

        <?php endif; ?>

    </nav>

</header>