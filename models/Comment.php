<?php

class Comment extends BaseModel
{
  // Lấy danh sách tất cả comments
  public function all()
  {
    $sql = "SELECT * FROM comments";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Thêm comment mới
  public function create($data)
  {
    $sql = "INSERT INTO comments (product_id, user_id, comment, rating, status, created_at, updated_at) 
            VALUES (:product_id, :user_id, :comment, :rating, :status, :created_at, :updated_at)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':product_id', $data['product_id']);
    $stmt->bindParam(':user_id', $data['user_id']);
    $stmt->bindParam(':comment', $data['comment']);
    $stmt->bindParam(':rating', $data['rating']);
    $stmt->bindParam(':status', $data['status']);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');
    $stmt->bindParam(':created_at', $created_at);
    $stmt->bindParam(':updated_at', $updated_at);
    $stmt->execute();
  }

  // Cập nhật comment theo id
  public function update($id, $data)
  {
    $sql = "UPDATE comments 
            SET product_id = :product_id, 
                user_id = :user_id, 
                comment = :comment, 
                rating = :rating, 
                status = :status, 
                updated_at = :updated_at 
            WHERE id = :id";

    $data['id'] = $id;
    $data['updated_at'] = date('Y-m-d H:i:s'); // Cập nhật thời gian hiện tại

    $stmt = $this->conn->prepare($sql);
    $stmt->execute($data);
  }

  // Xóa comment theo id
  public function delete($id)
  {
    $sql = "DELETE FROM comments WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);
  }

  // Lấy thông tin chi tiết của một comment theo id
  public function find($id)
  {
    $sql = "SELECT * FROM comments WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Lấy danh sách comments theo product_id
  public function getCommentByProductId($product_id)
  {
    $sql = "SELECT * FROM comments WHERE product_id = :product_id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['product_id' => $product_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Lấy danh sách comments theo user_id
  public function findByUserId($user_id)
  {
    $sql = "SELECT * FROM comments WHERE user_id = :user_id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
