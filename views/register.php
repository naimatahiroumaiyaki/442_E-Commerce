
<?php
require_once "../core/core.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Registration</title>
</head>

<body>
    <h1>Customer Registration</h1>

    <?php
    if (isset($_SESSION['error'])) {
        echo "<p>" . htmlspecialchars($_SESSION['error']) . "</p>";
        unset($_SESSION['error']);
    }
    ?>

    <form id="registerForm" action="../actions/register_action.php" method="POST">

        <div>
            <label>Full Name</label>
            <input type="text" name="name" id="name">
            <span class="error" id="nameError"></span>
        </div>

        <div>
            <label>Email</label>
            <input type="email" name="email" id="email">
            <span class="error" id="emailError"></span>
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="pass" id="pass">
            <span class="error" id="passError"></span>
        </div>

        <div>
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

        <div>
            <label>City</label>
            <input type="text" name="city" id="city">
            <span class="error" id="cityError"></span>
        </div>

        <div>
            <label>Contact Number</label>
            <input type="text" name="contact" id="contact">
            <span class="error" id="contactError"></span>
        </div>

        <div>
            <label>Address</label>
            <input type="text" name="address" id="address">
        </div>

        <div>
            <label>Profile Image (Optional)</label>
            <input type="file" name="customer_image" id="customer_image">
        </div>

        <div>
            <button type="submit" id="registerButton">Register</button>
        </div>

    </form>

    <script src="../js/validate.js"></script>

</body>
</html>

