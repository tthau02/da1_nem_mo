<?php

class AuthController
{
  public function login()
  {
    if (empty($_POST['loginIdentifier']) || empty($_POST['password'])) {
      $_SESSION['error_message'] = "Vui lòng nhập đầy đủ thông tin đăng nhập.";
      header("location: " . $_SERVER['HTTP_REFERER']);
      exit;
    }

    $loginIdentifier = trim($_POST['loginIdentifier']);
    $password = trim($_POST['password']);

    // Kiểm tra email hoặc username
    $user = filter_var($loginIdentifier, FILTER_VALIDATE_EMAIL)
      ? (new User)->findByEmail($loginIdentifier)
      : (new User)->findByUsername($loginIdentifier);

    if (!$user) {
      $_SESSION['error_message'] = "Email/Username không tồn tại.";
      header("location: " . $_SERVER['HTTP_REFERER']);
      exit;
    }

    // Kiểm tra mật khẩu
    if (!password_verify($password, $user['password'])) {
      $_SESSION['error_message'] = "Mật khẩu không đúng.";
      header("location: " . $_SERVER['HTTP_REFERER']);
      exit;
    }

    // Thiết lập session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_role'] = $user['role'];
    $_SESSION['message'] = "Đăng nhập thành công.";

    // Chuyển hướng
    $redirect = ($user['role'] === 'admin') ? "/admin" : "";
    header("location: " . ROOT_URL . $redirect);
    exit;
  }

  public function register()
  {
    try {
      // Kết nối database từ model User
      $user = new User();
      if (empty($_POST['fullname']) || empty($_POST['registerName']) || empty($_POST['registerEmail']) || empty($_POST['registerPassword']) || empty($_POST['registerConfirmPassword'])) {
        throw new Exception('Vui lòng nhập đầy đủ thông tin');
      }

      if ($_POST['registerPassword'] !== $_POST['registerConfirmPassword']) {
        throw new Exception('Mật khẩu không khớp');
      }

      if ($user->findByEmail($_POST['registerEmail'])) {
        throw new Exception('Email đã được sử dụng');
      }

      $hashedPassword = password_hash($_POST['registerPassword'], PASSWORD_BCRYPT);

      // Tạo mảng dữ liệu để lưu vào database
      $userData = [
        'fullname' => $_POST['fullname'],
        'username' => $_POST['registerName'],
        'email' => $_POST['registerEmail'],
        'password' => $hashedPassword,
      ];
      if (!$user->create($userData)) {
        throw new Exception('Không thể lưu thông tin người dùng, vui lòng thử lại sau');
      }

      // Phản hồi JSON khi thành công
      echo json_encode(['success' => true, 'message' => 'Đăng ký thành công!']);
    } catch (Exception $e) {
      http_response_code(400); // Báo lỗi 400
      echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
  }


  public function logout()
  {
    session_destroy();
    header("location: " . ROOT_URL);
    exit;
  }
}
