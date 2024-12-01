<?php

class Product extends BaseModel
{
    //lấy toàn bộ sản phẩm
    public function all()
    {
        $sql = "SELECT p.*, c.cate_name FROM products p JOIN categories c ON p.category_id=c.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllProduct($limit, $offset)
    {
        $sql = "
            SELECT p.*, c.cate_name 
            FROM products p 
            JOIN categories c ON p.category_id = c.id
            LIMIT :limit OFFSET :offset
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function count()
    {
        $sql = "SELECT COUNT(*) as total FROM products";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getProductNew($limit = 8)
    {
        $sql = "SELECT p.*, c.cate_name 
            FROM products p 
            JOIN categories c ON p.category_id = c.id 
            ORDER BY p.id DESC 
            LIMIT :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listProductInCategory($id)
    {
        $sql = "SELECT p.*, c.cate_name FROM products p JOIN categories c ON p.category_id=c.id WHERE c.id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function productInCategory($id)
    {
        $sql = "SELECT * FROM products 
                WHERE category_id = :id 
                LIMIT 8";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //lấy ra sản phẩm có rating cao nhất
    public function getTopRatedProducts($limit = 8)
    {
        $sql = "
            SELECT 
                products.*, 
                COALESCE(AVG(comments.rating), 0) AS avg_rating
            FROM products
            LEFT JOIN comments ON products.id = comments.product_id
            GROUP BY products.id
            ORDER BY avg_rating DESC
            LIMIT :limit
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //Thêm dữ liệu
    public function create($data)
    {
        $sql = "INSERT INTO products(name, image, price, quantity, description, status, category_id) VALUES(:name, :image, :price, :quantity, :description, :status, :category_id)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }
    //Cập nhật
    public function update($id, $data)
    {
        $sql = "UPDATE products SET name=:name, image=:image, price=:price, quantity=:quantity, description=:description, status=:status, category_id=:category_id WHERE id=:id";

        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id;
        var_dump($data);
        $stmt->execute($data);
    }

    public function find($id)
    {
        $sql = "SELECT * FROM products WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // Tìm kiếm sản phẩm theo tên 
    public function search($keyword = null)
    {
        $sql = "SELECT products.*, categories.cate_name AS category_name
            FROM products
            LEFT JOIN categories ON products.category_id = categories.id
            WHERE products.name LIKE :keyword OR categories.cate_name LIKE :keyword";

        $stmt = $this->conn->prepare($sql);
        $param = "%$keyword%";
        $stmt->bindParam(':keyword', $param, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 
    public function delete($id)
    {
        $sql = "UPDATE products  SET status=0  WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }


    public function filterProducts($minPrice = 0, $maxPrice = PHP_INT_MAX, $rating = null, $limit = 15, $offset = 0)
{
    $sql = "
        SELECT p.*, c.cate_name, COALESCE(AVG(cm.rating), 0) AS avg_rating
        FROM products p
        JOIN categories c ON p.category_id = c.id
        LEFT JOIN comments cm ON p.id = cm.product_id
        WHERE p.price BETWEEN :minPrice AND :maxPrice
        GROUP BY p.id
    ";

    if (!is_null($rating)) {
        $sql .= " HAVING avg_rating >= :rating";
    }

    $sql .= " LIMIT :limit OFFSET :offset";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':minPrice', $minPrice, PDO::PARAM_INT);
    $stmt->bindValue(':maxPrice', $maxPrice, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

    if (!is_null($rating)) {
        $stmt->bindValue(':rating', $rating, PDO::PARAM_INT);
    }

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function countFilteredProducts($minPrice = 0, $maxPrice = PHP_INT_MAX, $rating = null)
    {
        $sql = "
            SELECT COUNT(DISTINCT p.id) as total
            FROM products p
            JOIN categories c ON p.category_id = c.id
            LEFT JOIN comments cm ON p.id = cm.product_id
            WHERE p.price BETWEEN :minPrice AND :maxPrice
        ";
    
        if (!is_null($rating)) {
            $sql .= " GROUP BY p.id HAVING AVG(cm.rating) >= :rating";
        }
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':minPrice', $minPrice, PDO::PARAM_INT);
        $stmt->bindValue(':maxPrice', $maxPrice, PDO::PARAM_INT);
    
        if (!is_null($rating)) {
            $stmt->bindValue(':rating', $rating, PDO::PARAM_INT);
        }
    
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int)$result['total'] : 0;
    }
}
