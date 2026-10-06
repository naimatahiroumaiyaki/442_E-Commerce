<?php

require_once "../../core/core.php";

require_login();

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>My Account</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            color: #1f2937;
        }

        .account-container {
            max-width: 900px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .account-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
        }

        .account-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .account-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: #e0f2fe;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 38px;
        }

        .account-header h1 {
            margin: 0 0 10px;
            font-size: 32px;
            color: #111827;
        }

        .account-header p {
            margin: 0;
            color: #6b7280;
        }

        .account-info {
            border-top: 1px solid #e5e7eb;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 5px;
            border-bottom: 1px solid #e5e7eb;
        }

        .info-label {
            font-weight: 600;
            color: #374151;
        }

        .info-value {
            color: #6b7280;
        }

        .account-actions {
            margin-top: 30px;
            text-align: center;
        }

        .home-button {
            display: inline-block;
            padding: 12px 25px;
            background: #25cdeb;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
        }

        .home-button:hover {
            background: #1dc8d8;
        }

        .logout-button {
            display: inline-block;
            margin-left: 10px;
            padding: 12px 25px;
            background: #fee2e2;
            color: #dc2626;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
        }

        .logout-button:hover {
            background: #fecaca;
        }

        @media (max-width: 600px) {

            .account-card {
                padding: 25px;
            }

            .info-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 6px;
            }

            .logout-button {
                margin-left: 0;
                margin-top: 10px;
            }
        }

    </style>

</head>

<body>

<?php require_once "../layout/header.php"; ?>


<div class="account-container">

    <div class="account-card">

        <div class="account-header">

            <div class="account-icon">
                👤
            </div>

            <h1>My Account</h1>

            <p>
                View your account information
            </p>

        </div>


        <div class="account-info">

            <div class="info-row">

                <span class="info-label">
                    Name
                </span>

                <span class="info-value">
                    <?php echo htmlspecialchars($_SESSION['customer_name']); ?>
                </span>

            </div>


            <div class="info-row">

                <span class="info-label">
                    Email
                </span>

                <span class="info-value">
                    <?php echo htmlspecialchars($_SESSION['customer_email']); ?>
                </span>

            </div>


            <div class="info-row">

                <span class="info-label">
                    Account Type
                </span>

                <span class="info-value">

                    <?php
                    if ((int) $_SESSION['user_role'] === 1) {
                        echo "Administrator";
                    } else {
                        echo "Customer";
                    }
                    ?>

                </span>

            </div>

        </div>


        <div class="account-actions">

            <a href="../../index.php" class="home-button">
                Back to Home
            </a>

            <a href="../../logout.php" class="logout-button">
                Logout
            </a>

        </div>

    </div>

</div>

</body>

</html>