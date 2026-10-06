<?php
require_once "layout/header.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ecom LAB</title>

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

        .home-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 60px 20px;
        }

        /* Welcome section */

        .welcome-section {
            background: white;
            border-radius: 16px;
            padding: 60px 50px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
            margin-bottom: 50px;
        }

        .welcome-section h1 {
            font-size: 42px;
            margin-bottom: 15px;
            color: #111827;
        }

        .welcome-section h1 span {
            color: #25c7eb;
        }

        .welcome-section p {
            max-width: 650px;
            margin: 0 auto 30px;
            font-size: 17px;
            line-height: 1.7;
            color: #6b7280;
        }

        .shop-button {
            display: inline-block;
            padding: 13px 28px;
            background: #25c7eb;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
        }

        .shop-button:hover {
            background: #1db9d8;
        }

        /* Features */

        .section-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .section-title h2 {
            font-size: 30px;
            margin-bottom: 8px;
            color: #111827;
        }

        .section-title p {
            color: #6b7280;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .feature-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            border: 1px solid #e5e7eb;
            transition: 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.07);
        }

        .feature-card h3 {
            margin: 15px 0 10px;
            color: #111827;
        }

        .feature-card p {
            color: #6b7280;
            line-height: 1.6;
            margin: 0;
        }

        .feature-icon {
            font-size: 38px;
        }

        /* Bottom section */

        .bottom-section {
            margin-top: 50px;
            background: #111827;
            color: white;
            text-align: center;
            padding: 45px 20px;
            border-radius: 16px;
        }

        .bottom-section h2 {
            margin-bottom: 10px;
            font-size: 30px;
        }

        .bottom-section p {
            color: #d1d5db;
            margin-bottom: 25px;
        }

        .login-button {
            display: inline-block;
            padding: 12px 25px;
            background: white;
            color: #111827;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
        }

        .login-button:hover {
            background: #f3f4f6;
        }

        /* Mobile */

        @media (max-width: 768px) {

            .welcome-section {
                padding: 40px 25px;
            }

            .welcome-section h1 {
                font-size: 34px;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }

            .home-container {
                padding: 30px 15px;
            }
        }
    </style>
</head>

<body>

<div class="home-container">

    <section class="welcome-section">

        <h1>
            Welcome to <span>Ecom LAB</span>
        </h1>

        <p>
            Explore our e-commerce platform and enjoy a simple,
            secure, and user-friendly shopping experience.
        </p>


    </section>


    <section>

        <div class="section-title">

            <h2>Our Platform</h2>

            <p>
                Everything you need for a simple online shopping experience.
            </p>

        </div>


        <div class="feature-grid">

            <div class="feature-card">

                <div class="feature-icon">🛒</div>

                <h3>Easy Shopping</h3>

                <p>
                    Browse products and enjoy a simple shopping experience.
                </p>

            </div>


            <div class="feature-card">

                <div class="feature-icon">🔐</div>

                <h3>Secure Login</h3>

                <p>
                    Your account is protected with secure authentication.
                </p>

            </div>


            <div class="feature-card">

                <div class="feature-icon">⚡</div>

                <h3>Simple & Fast</h3>

                <p>
                    Access the platform easily and manage your account.
                </p>

            </div>

        </div>

    </section>




</div>

</body>
</html>