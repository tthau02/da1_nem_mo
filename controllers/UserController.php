<?php

class UserController
{
  public function edit()
  {
    if (empty($_SESSION['user_id'])) {
      $_SESSION['error_message'] = "Bạn chưa đăng nhập!";
      header("Location: " . ROOT_URL . "?ctl=login"); 
      exit();
    }

    $id = $_SESSION['user_id'];
    $user = (new User)->find($id);
    if (!$user) {
      $_SESSION['error_message'] = "Không tìm thấy người dùng!";
      header("Location: " . ROOT_URL . "?ctl=profile"); 
      exit();
    }

    $title = "Thông tin người dùng";
    return view(
      "client.users.profile",
      compact('user',  'title')
    );
  }

  public function update()
  {
      if (empty($_SESSION['user_id'])) {
          $_SESSION['error_message'] = "Bạn chưa đăng nhập!";
          header("Location: " . ROOT_URL . "?ctl=login");
          exit();
      }
  
      $id = $_SESSION['user_id'];
      $data = $_POST;
      $userModel = new User();
      $currentUser = $userModel->find($id);
  
      if (!$currentUser) {
          $_SESSION['error_message'] = "Người dùng không tồn tại!";
          header("Location: " . ROOT_URL . "?ctl=login");
          exit();
      }
  
      $file = $_FILES['image'] ?? null;
      dd($file);
      if ($file && $file['size'] > 0) {
          $imagePath = "assets/images/account" . basename($file['name']);
          if (move_uploaded_file($file['tmp_name'], ROOT_DIR . $imagePath)) {
              $data['image'] = $imagePath; 
          } else {
              $_SESSION['error_message'] = "Không thể tải lên ảnh!";
              header("Location: " . ROOT_URL . "?ctl=edit-profile");
              exit();
          }
      } else {
          $data['image'] = $currentUser['image']; 
      }

      if (!empty($data['password'])) {
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
      } else {
          unset($data['password']);
      }
     
      unset($data['updateProfileUser']);
      if ($userModel->update($id, $data)) {
          $_SESSION['success_message'] = "Cập nhật thông tin thành công!";
      } else {
          $_SESSION['error_message'] = "Cập nhật thông tin thất bại!";
      }
  
      header("Location: " . ROOT_URL . "?ctl=edit-profile");
      exit();
  }
  
  public function updateUser()
  {
    if (empty($_POST['id']) || empty($_POST['username']) || empty($_POST['email'])) {
      $_SESSION['error_message'] = "Vui lòng nhập đầy đủ thông tin";
      return;
    }

    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $_SESSION['error_message'] = "Địa chỉ email không hợp lệ";
      return;
    }

    // Kiểm tra nếu username hoặc email đã tồn tại
    $user = new User;
    if ($user->findByUsername($username) && $user->findByUsername($username)['id'] != $id) {
      $_SESSION['error_message'] = "Username đã tồn tại";
      return;
    }
    if ($user->findByEmail($email) && $user->findByEmail($email)['id'] != $id) {
      $_SESSION['error_message'] = "Email đã tồn tại";
      return;
    }

    // Xử lý upload ảnh
    $image = $user->find($id)['image']; // Giá trị hiện tại
    if (!empty($_FILES['image']['name'])) {
      $target_dir = "uploads/";
      $target_file = $target_dir . basename($_FILES["image"]["name"]);
      move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
      $image = $target_file;
    }

    // Cập nhật thông tin người dùng
    $data = [
      'fullname' => $_POST['fullname'],
      'username' => $username,
      'email' => $email,
      'phone' => $_POST['phone'],
      'address' => $_POST['address'],
      'role' => $_POST['role'],
      'image' => $image,
      'status' => $_POST['status']
    ];
    $user->update($id, $data);

    $_SESSION['message'] = "Cập nhật thông tin thành công";
    header("location: " . ROOT_URL . "?ctl=profile");
  }
}
