<?php

require_once '../../core/core.php';
require_admin();

require_once '../../controllers/ProductController.php';

$controller = new ProductController();

$categories = $controller->getAllCategories();

$editCategory = null;

if (isset($_GET['edit_id'])) {

    $edit_id = $_GET['edit_id'];

    if (ctype_digit($edit_id) && (int)$edit_id > 0) {
        $editCategory = $controller->getCategoryById((int)$edit_id);
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>Manage Categories</title>

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

        .category-container {
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

        .category-form {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
        }

        .category-form input {
            flex: 1;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            padding: 11px 18px;
            border: none;
            border-radius: 6px;
            background: #25c7eb;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background: #1db3d8;
        }

        .edit-link {
            display: inline-block;
            padding: 8px 14px;
            background: #25c0eb;
            color: white;
            text-decoration: none;
            border-radius: 6px;
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

<div class="category-container">

    <h1>Manage Categories</h1>

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

    <form class="category-form"
            action="<?php echo $editCategory
                ? '../../actions/update_category_action.php'
                : '../../actions/add_category_action.php'; ?>"
            method="POST">
        <?php if ($editCategory): ?>

            <input type="hidden"
                name="cat_id"
                value="<?php echo htmlspecialchars($editCategory['cat_id']); ?>">

        <?php endif; ?>

        <input type="text"
            name="cat_name"
            placeholder="Category Name"
            value="<?php echo $editCategory
                ? htmlspecialchars($editCategory['cat_name'])
                : ''; ?>"
            required>

        <button type="submit">
            <?php echo $editCategory ? 'Update Category' : 'Add Category'; ?>
        </button>

    </form>

    <table>

        <tr>
            <th>Category Name</th>
            <th>Action</th>
        </tr>

        <?php foreach ($categories as $category): ?>

            <tr>

                <td>
                    <?php echo htmlspecialchars($category['cat_name']); ?>
                </td>

                <td>
                    <a class="edit-link"
                       href="?edit_id=<?php echo $category['cat_id']; ?>">
                        Edit
                    </a>
                </td>

            </tr>

        <?php endforeach; ?>

    </table>

</div>

</body>
</html>