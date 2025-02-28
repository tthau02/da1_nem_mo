<?php

class User extends BaseModel
{
  // Lấy danh sách tất cả user
  public function all()
  {
    $sql = "SELECT * FROM users";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Thêm user mới
  public function create($data)
  {
    try {
      $sql = "INSERT INTO users (fullname, username, password, email, phone, address, role, created_at, updated_at)
                  VALUES (:fullname, :username, :password, :email, :phone, :address, :role, :created_at, :updated_at)";
      $stmt = $this->conn->prepare($sql);

      // Gắn các giá trị
      $stmt->bindParam(':fullname', $data['fullname']);
      $stmt->bindParam(':username', $data['username']);
      $stmt->bindParam(':password', $data['password']);
      $stmt->bindParam(':email', $data['email']);
      $stmt->bindParam(':phone', $data['phone']);
      $stmt->bindParam(':address', $data['address']);
      $stmt->bindParam(':role', $data['role']);

      // Gắn thời gian
      $created_at = date('Y-m-d H:i:s');
      $updated_at = date('Y-m-d H:i:s');
      $stmt->bindParam(':created_at', $created_at);
      $stmt->bindParam(':updated_at', $updated_at);

      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      throw new Exception("Lỗi SQL: " . $e->getMessage());
    }
  }

  // Cập nhật user theo id
  public function update($id, $data)
  {
    //Nếu trường nào thiếu thì lấy dữ liệu cũ
    $user = $this->find($id);
    $data = array_merge($user, $data);
    // Bỏ cột password nếu không nhập mật khẩu mới
    $sql = "UPDATE users SET 
            fullname = :fullname, 
            username = :username, 
            email = :email, 
            image = :image,
            phone = :phone, 
            address = :address, 
            updated_at = :updated_at";

    if (!empty($data['password'])) {
      $sql .= ", password = :password"; // Cập nhật nếu có mật khẩu mới
    }

    $sql .= " WHERE id = :id";

    $data['id'] = $id;
    $data['updated_at'] = date('Y-m-d H:i:s');

    // Xóa key không cần thiết
    if (empty($data['password'])) {
      unset($data['password']);
    }

    $stmt = $this->conn->prepare($sql);

    // Gắn các giá trị
    $stmt->bindParam(':fullname', $data['fullname']);
    $stmt->bindParam(':username', $data['username']);
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':image', $data['image']);
    $stmt->bindParam(':phone', $data['phone']);
    $stmt->bindParam(':address', $data['address']);
    $stmt->bindParam(':updated_at', $data['updated_at']);
    $stmt->bindParam(':id', $data['id']);

    if (!empty($data['password'])) {
      $stmt->bindParam(':password', $data['password']);
    }

    return $stmt->execute(); // Chạy câu lệnh với dữ liệu phù hợp
  }


  // Xóa user theo id
  public function delete($id)
  {
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);
  }

  // Lấy thông tin chi tiết của một user theo id
  public function find($id)
  {
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Tìm user theo email
  public function findByEmail($email)
  {
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Tìm kiếm user theo tên

  public function findByUsername($username)
  {
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }


  // Tìm kiếm user theo tên
  public function search($fullname)
  {
    $sql = "SELECT * FROM users WHERE fullname LIKE :fullname";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':fullname', '%' . $fullname . '%');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
