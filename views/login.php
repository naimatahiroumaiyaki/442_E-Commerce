
<?php
require_once "../core/core.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Login</title>
</head>

<body>

    <h1>Customer Login</h1>

    <?php
    if (isset($_SESSION['error'])) {
        echo "<p>" . htmlspecialchars($_SESSION['error']) . "</p>";
        unset($_SESSION['error']);
    }
    ?>

    <form action="../actions/login_action.php" method="POST">

        <div>
            <label>Email</label>
            <input type="email" name="email">
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="pass">
        </div>

        <div>
            <button type="submit">Login</button>
        </div>

    </form>

    <p>
        Don't have an account?
        <a href="register.php">Register</a>
    </p>

</body>
</html>

