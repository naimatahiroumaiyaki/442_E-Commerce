
<?php
require_once "../core/core.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Registration</title>

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
            max-width: 520px;
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
            border-color: #25ebe8;
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

        .error {
            display: block;
            color: #dc2626;
            font-size: 13px;
            margin-top: 4px;
        }

        .register-button {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 7px;
            background: #25ebd1;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }

        .register-button:hover {
            background: #1dc2d8;
        }

        @media (max-width: 600px) {

            .auth-container {
                padding: 20px 15px;
            }

            .auth-card {
                padding: 25px 20px;
            }

        }
        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #6b7280;
        }

        .login-link a {
            color: #25deeb;
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
        .password-hint {
            display: block;
            margin-top: 6px;
            color: #6b7280;
            font-size: 13px;
        }

    </style>

</head>



<body>

<div class="auth-container">

    <div class="auth-card">

        <h1>Customer Registration</h1>

        <p class="subtitle">
            Create your customer account.
        </p>

        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="error-message">'
                . htmlspecialchars($_SESSION['error'])
                . '</div>';
            unset($_SESSION['error']);
        }
        ?>

        <form id="registerForm"
              action="../actions/register_action.php"
              method="POST">

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" id="name">
                <span class="error" id="nameError"></span>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="email">
                <span class="error" id="emailError"></span>
            </div>

            <div class="form-group">
                <label>Password</label>
                <small class="password-hint">
                    Password must contain at least 8 characters, one uppercase letter,
                    one lowercase letter, and one number.
                </small>
                <input type="password" name="pass" id="pass">
                <span class="error" id="passError"></span>
            </div>


        <div class = "form-group">
            <label>Country</label>

            <input type="text"
                name="country"
                id="country"
                list="countries"
                placeholder="Type your country..."
                autocomplete="off">

            <datalist id="countries">
                <option value="Afghanistan">
                <option value="Albania">
                <option value="Algeria">
                <option value="Angola">
                <option value="Argentina">
                <option value="Australia">
                <option value="Austria">

                <option value="Bahamas">
                <option value="Bahrain">
                <option value="Bangladesh">
                <option value="Barbados">
                <option value="Belgium">
                <option value="Belize">
                <option value="Benin">
                <option value="Bhutan">
                <option value="Bolivia">
                <option value="Botswana">
                <option value="Brazil">
                <option value="Brunei">
                <option value="Bulgaria">
                <option value="Burkina Faso">
                <option value="Burundi">

                <option value="Cameroon">
                <option value="Canada">
                <option value="Chad">
                <option value="Chile">
                <option value="China">
                <option value="Colombia">
                <option value="Congo">

                <option value="Denmark">
                <option value="Djibouti">
                <option value="Dominica">

                <option value="Egypt">
                <option value="Ethiopia">

                <option value="France">

                <option value="Gabon">
                <option value="Gambia">
                <option value="Georgia">
                <option value="Germany">
                <option value="Ghana">
                <option value="Greece">
                <option value="Guinea">

                <option value="India">
                <option value="Indonesia">
                <option value="Ireland">
                <option value="Italy">

                <option value="Japan">
                <option value="Jordan">

                <option value="Kenya">

                <option value="Liberia">
                <option value="Libya">

                <option value="Madagascar">
                <option value="Malawi">
                <option value="Malaysia">
                <option value="Mali">
                <option value="Mauritania">
                <option value="Mauritius">
                <option value="Mexico">
                <option value="Morocco">
                <option value="Mozambique">

                <option value="Namibia">
                <option value="Nauru">
                <option value="Nepal">
                <option value="Netherlands">
                <option value="New Zealand">
                <option value="Nicaragua">
                <option value="Niger">
                <option value="Nigeria">
                <option value="Norway">

                <option value="Pakistan">
                <option value="Panama">
                <option value="Peru">
                <option value="Philippines">
                <option value="Poland">
                <option value="Portugal">

                <option value="Rwanda">

                <option value="Senegal">
                <option value="Sierra Leone">
                <option value="Singapore">
                <option value="Somalia">
                <option value="South Africa">
                <option value="South Korea">
                <option value="Spain">
                <option value="Sudan">
                <option value="Sweden">
                <option value="Switzerland">

                <option value="Tanzania">
                <option value="Thailand">
                <option value="Togo">
                <option value="Tunisia">
                <option value="Turkey">

                <option value="Uganda">
                <option value="Ukraine">
                <option value="United Kingdom">
                <option value="United States">

                <option value="Zambia">
                <option value="Zimbabwe">
            </datalist>

            <span class="error" id="countryError"></span>
        </div>

        <div class = "form-group">
            <label>City</label>
            <input type="text" name="city" id="city">
            <span class="error" id="cityError"></span>
        </div>

        <div class = "form-group">
            <label>Contact Number</label>
            <input type="text" name="contact" id="contact">
            <span class="error" id="contactError"></span>
        </div>

        <div class = "form-group">
            <label>Address</label>
            <input type="text" name="address" id="address">
        </div>

        <div class = "form-group">
            <label>Profile Image (Optional)</label>
            <input type="file" name="customer_image" id="customer_image">
        </div>

        <div class = "form-group">
            <button type="submit"
                id="registerButton"
                class = "register-button">
                Register
            </button>
        </div>

        <div class="login-link">
            Already registered?
            <a href="login.php">Login</a>
        </div>
    </form>

    <script src="../js/validate.js"></script>

</body>
</html>

