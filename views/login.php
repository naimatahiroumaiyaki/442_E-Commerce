<?php
require_once "../core/core.php";
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Customer Login</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fa;
            color: #222;
        }

        .auth-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .auth-card {
            width: 100%;
            max-width: 450px;
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .auth-card h1 {
            text-align: center;
            margin-bottom: 8px;
            color: #1f2937;
        }

        .subtitle {
            text-align: center;
            color: #6b7280;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
            color: #374151;
        }

        .form-group input {
            width: 100%;
            padding: 11px 13px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            font-size: 15px;
            outline: none;
            background: white;
        }

        .form-group input:focus {
            border-color: #25cdeb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .error-message {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .login-button {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 7px;
            background: #25d1eb;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }

        .login-button:hover {
            background: #1db9d8;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            color: #6b7280;
        }

        

        .register-link a {
            color: #25d1eb;
            font-weight: 600;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {

            .auth-container {
                padding: 20px 15px;
            }

            .auth-card {
                padding: 25px 20px;
            }

        }

    </style>

</head>

<body>

<div class="auth-container">

    <div class="auth-card">

        <h1>Customer Login</h1>

        <p class="subtitle">
            Login to your customer account.
        </p>

        <?php
        
        if (isset($_SESSION['error'])) {

            echo '<div class="error-message">'
                . htmlspecialchars($_SESSION['error'])
                . '</div>';

            unset($_SESSION['error']);
        }
        ?>

        <form action="../actions/login_action.php" method="POST">

            <div class="form-group">

                <label>Email</label>

                <input type="email"
                       name="email"
                       required>

            </div>


            <div class="form-group">

                <label>Password</label>

                <input type="password"
                       name="pass"
                       required>

            </div>


            <div class="form-group">

                <button type="submit"
                        class="login-button">

                    Login

                </button>

            </div>

        </form>


        <div class="register-link">

            Don't have an account?
            <a href="register.php">Register</a>

        </div>

    </div>

</div>

</body>
</html>