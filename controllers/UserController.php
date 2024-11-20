<?php

class UserController
{
  //Hmf edit dùng để hiển thị form cập nhật
  public function edit()
  {
    // Kiểm tra nếu user_id không tồn tại trong session
    if (empty($_SESSION['user_id'])) {
      $_SESSION['error_message'] = "Bạn chưa đăng nhập!";
      header("Location: " . ROOT_URL . "?ctl=login"); // Điều hướng về trang login
      exit();
    }

    // Lấy user_id từ session
    $id = $_SESSION['user_id'];

    // Lấy thông tin người dùng dựa trên id từ cơ sở dữ liệu
    $user = (new User)->find($id);
    if (!$user) {
      $_SESSION['error_message'] = "Không tìm thấy người dùng!";
      header("Location: " . ROOT_URL . "?ctl=profile"); // Điều hướng về trang profile nếu không tìm thấy người dùng
      exit();
    }

    // Tiêu đề cho trang sửa thông tin người dùng
    $title = "Thông tin người dùng";

    // Trả về view với dữ liệu đã chuẩn bị
    return view(
      "client.users.profile",
      compact('user',  'title')
    );
  }

  public function updateUser()
  {
    // Kiểm tra nếu dữ liệu POST không đầy đủ
    if (empty($_POST['id']) || empty($_POST['username']) || empty($_POST['email'])) {
      $_SESSION['error_message'] = "Vui lòng nhập đầy đủ thông tin";
      return;
    }

    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Kiểm tra định dạng email
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
