<?php

require_once '../../core/core.php';
require_admin();

require_once '../../controllers/ProductController.php';

$controller = new ProductController();

$brands = $controller->getAllBrands();

$editBrand = null;

if (isset($_GET['edit_id'])) {

    $edit_id = $_GET['edit_id'];

    if (ctype_digit($edit_id) && (int)$edit_id > 0) {
        $editBrand = $controller->getBrandById((int)$edit_id);
    }
}

?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">

    <title>Manage Brands</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 40px;
            color: #222;
        }

        .brand-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 35px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        h1 {
            margin-bottom: 25px;
            color: #1f2937;
        }

        .message {
            padding: 12px;
            margin-bottom: 20px;
            background: #dcfce7;
            color: #166534;
            border-radius: 6px;
        }

        .error-message {
            padding: 12px;
            margin-bottom: 20px;
            background: #fee2e2;
            color: #b91c1c;
            border-radius: 6px;
        }

        .brand-form {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
        }

        .brand-form input {
            flex: 1;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            padding: 11px 18px;
            border: none;
            border-radius: 6px;
            background: #25d4eb;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background: #1dc2d8;
        }

        .edit-link {
            display: inline-block;
            padding: 8px 14px;
            background: #25caeb;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .edit-link:hover {
            background: #1dc8d8;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #f3f4f6;
        }

    </style>

</head>

<body>

<div class="brand-container">

    <h1>Manage Brands</h1>

    <?php

    if (isset($_SESSION['success'])) {

        echo '<div class="message">'
            . htmlspecialchars($_SESSION['success'])
            . '</div>';

        unset($_SESSION['success']);
    }

    if (isset($_SESSION['error'])) {

        echo '<div class="error-message">'
            . htmlspecialchars($_SESSION['error'])
            . '</div>';

        unset($_SESSION['error']);
    }

    ?>

    <form class="brand-form"
          action="<?php echo $editBrand
              ? '../../actions/update_brand_action.php'
              : '../../actions/add_brand_action.php'; ?>"
          method="POST">

        <?php if ($editBrand): ?>

            <input type="hidden"
                   name="brand_id"
                   value="<?php echo htmlspecialchars($editBrand['brand_id']); ?>">

        <?php endif; ?>

        <input type="text"
               name="brand_name"
               placeholder="Brand Name"
               value="<?php echo $editBrand
                   ? htmlspecialchars($editBrand['brand_name'])
                   : ''; ?>"
               required>

        <button type="submit">
            <?php echo $editBrand ? 'Update Brand' : 'Add Brand'; ?>
        </button>

    </form>

    <?php if ($editBrand): ?>

        <p>
            <a href="brand.php">Cancel Edit</a>
        </p>

    <?php endif; ?>

    <table>

        <tr>
            <th>Brand Name</th>
            <th>Action</th>
        </tr>

        <?php foreach ($brands as $brand): ?>

            <tr>

                <td>
                    <?php echo htmlspecialchars($brand['brand_name']); ?>
                </td>

                <td>
                    <a class="edit-link"
                       href="?edit_id=<?php echo $brand['brand_id']; ?>">
                        Edit
                    </a>
                </td>

            </tr>

        <?php endforeach; ?>

    </table>

</div>

</body>
</html>