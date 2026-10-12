<?php
require_once "../../core/core.php";

require_admin();

require_once "../../controllers/ProductController.php";

$productController = new ProductController();
$products = $productController->getAllProducts();

require_once "../layout/header.php";
?>

<div style="max-width:1100px; margin:40px auto; padding:20px;">

    <h2 style="margin-bottom:20px;">Product Management</h2>

    <a href="product.php"
       style="display:inline-block; background:#007bff; color:white;
       padding:10px 15px; text-decoration:none; border-radius:5px;
       margin-bottom:20px;">
        + Add New Product
    </a>

    <?php if (isset($_SESSION['success'])): ?>
        <p style="color:green;">
            <?php
            echo htmlspecialchars($_SESSION['success']);
            unset($_SESSION['success']);
            ?>
        </p>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <p style="color:red;">
            <?php
            echo htmlspecialchars($_SESSION['error']);
            unset($_SESSION['error']);
            ?>
        </p>
    <?php endif; ?>

    <?php if (!empty($products)): ?>

        <div style="overflow-x:auto;">

            <table style="width:100%; border-collapse:collapse;
                          background:white;">

                <thead>
                    <tr style="background:#f2f2f2;">
                        <th style="padding:12px; border:1px solid #ddd;">ID</th>
                        <th style="padding:12px; border:1px solid #ddd;">Image</th>
                        <th style="padding:12px; border:1px solid #ddd;">Product Name</th>
                        <th style="padding:12px; border:1px solid #ddd;">Category</th>
                        <th style="padding:12px; border:1px solid #ddd;">Brand</th>
                        <th style="padding:12px; border:1px solid #ddd;">Price</th>
                        <th style="padding:12px; border:1px solid #ddd;">Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($products as $product): ?>

                        <tr>
                            <td style="padding:10px; border:1px solid #ddd;">
                                <?php echo (int)$product['product_id']; ?>
                            </td>

                            <td style="padding:10px; border:1px solid #ddd;">
                                <?php if (!empty($product['product_image'])): ?>
                                    <img
                                        src="../../images/products/<?php
                                        echo rawurlencode(basename($product['product_image']));
                                        ?>"
                                        alt="Product image"
                                        style="width:60px; height:60px; object-fit:cover;"
                                    >
                                <?php else: ?>
                                    No image
                                <?php endif; ?>
                            </td>

                            <td style="padding:10px; border:1px solid #ddd;">
                                <?php echo htmlspecialchars($product['product_title']); ?>
                            </td>

                            <td style="padding:10px; border:1px solid #ddd;">
                                <?php echo htmlspecialchars($product['cat_name']); ?>
                            </td>

                            <td style="padding:10px; border:1px solid #ddd;">
                                <?php echo htmlspecialchars($product['brand_name']); ?>
                            </td>

                            <td style="padding:10px; border:1px solid #ddd;">
                                <?php echo number_format((float)$product['product_price'], 2); ?>
                            </td>

                            <td style="padding:10px; border:1px solid #ddd;">
                                <a
                                    href="product.php?edit_id=<?php echo (int)$product['product_id']; ?>"
                                    style="display:inline-block; background:#28a745;
                                    color:white; padding:8px 12px;
                                    text-decoration:none; border-radius:4px;"
                                >
                                    Edit
                                </a>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>

        </div>

    <?php else: ?>

        <p>No products have been added yet.</p>

    <?php endif; ?>

</div>

