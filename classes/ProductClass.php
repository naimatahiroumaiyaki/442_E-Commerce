<?php
require_once __DIR__ . '/../core/db_class.php';

class ProductClass extends Database
{
    public function addBrand($name)
    {
        $stmt = $this->conn->prepare(
            'INSERT INTO brands (brand_name) VALUES (?)'
        );

        $stmt->bind_param('s', $name);

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }

    public function getAllBrands()
    {
        $stmt = $this->conn->prepare(
            'SELECT * FROM brands ORDER BY brand_name ASC'
        );

        $stmt->execute();

        $result = $stmt->get_result();

        $brands = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $brands;
    }
    public function getBrandById($id)
    {
        $stmt = $this->conn->prepare(
            'SELECT * FROM brands WHERE brand_id = ?'
        );

        $stmt->bind_param('i', $id);

        $stmt->execute();

        $result = $stmt->get_result();

        $brand = $result->fetch_assoc();

        $stmt->close();

        return $brand;
    }

    public function updateBrand($id, $name)
    {
        $stmt = $this->conn->prepare(
            'UPDATE brands SET brand_name = ? WHERE brand_id = ?'
        );

        $stmt->bind_param('si', $name, $id);

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }
    public function addCategory($name)
    {
        $stmt = $this->conn->prepare(
            'INSERT INTO categories (cat_name) VALUES (?)'
        );

        $stmt->bind_param('s', $name);

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }



    public function getAllCategories()
    {
        $stmt = $this->conn->prepare(
            'SELECT * FROM categories ORDER BY cat_name ASC'
        );

        $stmt->execute();

        $result = $stmt->get_result();

        $categories = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $categories;
    }
    public function getCategoryById($id)
    {
        $stmt = $this->conn->prepare(
            'SELECT * FROM categories WHERE cat_id = ?'
        );

        $stmt->bind_param('i', $id);

        $stmt->execute();

        $result = $stmt->get_result();

        $category = $result->fetch_assoc();

        $stmt->close();

        return $category;
    }

    public function updateCategory($id, $name)
    {
        $stmt = $this->conn->prepare(
            'UPDATE categories SET cat_name = ? WHERE cat_id = ?'
        );

        $stmt->bind_param('si', $name, $id);

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }

    public function addProduct($cat, $brand, $title, $price, $desc, $image_filename, $keywords)
    {
        $stmt = $this->conn->prepare(
            'INSERT INTO products (
                product_cat,
                product_brand,
                product_title,
                product_price,
                product_desc,
                product_image,
                product_keywords
            ) VALUES (?, ?, ?, ?, ?, ?, ?)'
        );

        $stmt->bind_param(
            'iisdsss',
            $cat,
            $brand,
            $title,
            $price,
            $desc,
            $image_filename,
            $keywords
        );

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }

        public function updateProduct(
        $id,
        $cat,
        $brand,
        $title,
        $price,
        $desc,
        $image_filename,
        $keywords
    ) {
        $stmt = $this->conn->prepare(
            'UPDATE products
             SET product_cat = ?,
                 product_brand = ?,
                 product_title = ?,
                 product_price = ?,
                 product_desc = ?,
                 product_image = ?,
                 product_keywords = ?
             WHERE product_id = ?'
        );

        $stmt->bind_param(
            'iisdsssi',
            $cat,
            $brand,
            $title,
            $price,
            $desc,
            $image_filename,
            $keywords,
            $id
        );

        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }

    public function getProductById($id)
    {
        $stmt = $this->conn->prepare(
            'SELECT products.*,
                    categories.cat_name,
                    brands.brand_name
             FROM products
             INNER JOIN categories
                 ON products.product_cat = categories.cat_id
             INNER JOIN brands
                 ON products.product_brand = brands.brand_id
             WHERE products.product_id = ?'
        );

        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        $stmt->close();

        return $product;
    }

    public function getAllProducts()
    {
        $stmt = $this->conn->prepare(
            'SELECT
                products.*,
                categories.cat_name,
                brands.brand_name
            FROM products
            INNER JOIN categories
                ON products.product_cat = categories.cat_id
            INNER JOIN brands
                ON products.product_brand = brands.brand_id
            ORDER BY products.product_id DESC'
        );

        $stmt->execute();

        $result = $stmt->get_result();
        $products = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $products;
    }

    public function deleteBrand($id)
    {
        $stmt = $this->conn->prepare(
            'DELETE FROM brands WHERE brand_id = ?'
        );

        $stmt->bind_param('i', $id);

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }

    public function deleteCategory($id)
    {
        $stmt = $this->conn->prepare(
            'DELETE FROM categories WHERE cat_id = ?'
        );

        $stmt->bind_param('i', $id);

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }

    public function getFeaturedProducts($limit = 6)
    {
        $limit = max(1, min((int)$limit, 50));

        $stmt = $this->conn->prepare(
            'SELECT * FROM products ORDER BY RAND() LIMIT ?'
        );

        $stmt->bind_param('i', $limit);
        $stmt->execute();

        $result = $stmt->get_result();
        $products = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $products;
    }

    public function getProductsByCategory($cat_id)
    {
        $stmt = $this->conn->prepare(
            'SELECT * FROM products WHERE product_cat = ?'
        );

        $stmt->bind_param('i', $cat_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $products = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $products;
    }

    public function getProductsByBrand($brand_id)
    {
        $stmt = $this->conn->prepare(
            'SELECT * FROM products WHERE product_brand = ?'
        );

        $stmt->bind_param('i', $brand_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $products = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $products;
    }

    public function searchProducts($query)
    {
        $search = '%' . $query . '%';

        $stmt = $this->conn->prepare(
            'SELECT * FROM products
            WHERE product_title LIKE ?
            OR product_keywords LIKE ?'
        );

        $stmt->bind_param('ss', $search, $search);
        $stmt->execute();

        $result = $stmt->get_result();
        $products = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $products;
    }
}

?> 