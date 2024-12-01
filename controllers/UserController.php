<?php

class UserController
{
  public function edit()
  {
    $categories = (new Category)->all();
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
      compact('user','categories', 'title')
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
}
