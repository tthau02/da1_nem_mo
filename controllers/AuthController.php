<?php


class AuthController
{
  public function login()
  {
    // Kiểm tra nếu dữ liệu POST không đầy đủ
    if (empty($_POST['loginIdentifier']) || empty($_POST['password'])) {
      $_SESSION['error_message'] = "Vui lòng nhập đầy đủ thông tin đăng nhập";
      return;
    }

    $loginIdentifier = $_POST['loginIdentifier'];
    $password = $_POST['password'];

    // Kiểm tra nếu loginIdentifier là email
    if (filter_var($loginIdentifier, FILTER_VALIDATE_EMAIL)) {
      // Tìm user bằng email
      $user = (new User)->findByEmail($loginIdentifier);
    } else {
      // Tìm user bằng username
      $user = (new User)->findByUsername($loginIdentifier);
    }

    // Kiểm tra nếu tìm thấy user và mật khẩu đúng
    if ($user && password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['message'] = "Đăng nhập thành công";

      // Kiểm tra role của user
      if ($user['role'] === 'admin') {
        header("location: " . ROOT_URL . "/admin"); // Chuyển hướng đến trang admin nếu là admin
      } else {
        header("location: " . ROOT_URL); // Chuyển hướng đến trang chủ nếu không phải admin
      }
      exit;
    } else {
      // Hiển thị thông báo lỗi
      $_SESSION['error_message'] = "Email/Username hoặc mật khẩu không đúng";
    }
  }

  // Xử lý đăng ký
  public function register()
  {
    // Kiểm tra nếu dữ liệu POST không đầy đủ
    if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirmPassword'])) {
      $_SESSION['error_message'] = "Vui lòng nhập đầy đủ thông tin đăng ký";
      return;
    }

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Kiểm tra định dạng email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $_SESSION['error_message'] = "Địa chỉ email không hợp lệ";
      return;
    }

    // Kiểm tra độ dài mật khẩu
    if (strlen($password) < 6) {
      $_SESSION['error_message'] = "Mật khẩu phải có ít nhất 6 ký tự";
      return;
    }

    // Kiểm tra mật khẩu và xác nhận mật khẩu có khớp nhau không
    if ($password !== $confirmPassword) {
      $_SESSION['error_message'] = "Mật khẩu và xác nhận mật khẩu không khớp";
      return;
    }

    // Kiểm tra nếu username hoặc email đã tồn tại
    $user = new User;
    if ($user->findByUsername($username)) {
      $_SESSION['error_message'] = "Username đã tồn tại";
      return;
    }
    if ($user->findByEmail($email)) {
      $_SESSION['error_message'] = "Email đã tồn tại";
      return;
    }

    // Mã hóa mật khẩu và tạo user mới
    $data = $_POST;
    var_dump($data);
    $data['password'] = password_hash($password, PASSWORD_BCRYPT);
    unset($data['submitFormRegister']);
    $user->create($data);

    $_SESSION['message'] = "Đăng ký thành công";
    header("location: " . ROOT_URL);
  }

  // Xử lý đăng xuất
  public function logout()
  {
    session_destroy();
    header("location: " . ROOT_URL);
  }
}
