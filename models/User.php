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
    $sql = "INSERT INTO users (fullname, username, password, email, phone, address, role, created_at, updated_at) VALUES (:fullname, :username, :password, :email, :phone, :address, :role, :created_at, :updated_at)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':fullname', $data['fullname']);
    $stmt->bindParam(':username', $data['username']);
    $stmt->bindParam(':password', $data['password']);
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':phone', $data['phone']);
    $stmt->bindParam(':address', $data['address']);
    $stmt->bindParam(':role', $data['role']);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');
    $stmt->bindParam(':created_at', $created_at);
    $stmt->bindParam(':updated_at', $updated_at);
    $stmt->execute();
  }
  // Cập nhật user theo id
  public function update($id, $data)
  {
    $sql = "UPDATE users 
            SET fullname = :fullname, 
                username = :username, 
                password = :password, 
                email = :email, 
                phone = :phone, 
                address = :address, 
                role = :role, 
                updated_at = :updated_at 
            WHERE id = :id";

    $data['id'] = $id;
    $data['updated_at'] = date('Y-m-d H:i:s'); // Cập nhật thời gian hiện tại

    $stmt = $this->conn->prepare($sql);
    $stmt->execute($data);
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
