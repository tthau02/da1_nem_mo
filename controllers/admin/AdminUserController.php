<?php

class AdminUserController
{
  public function index()
  {
    $message = $_SESSION['message'] ?? '';
    unset($_SESSION['message']);
    $users = (new User)->all();
    $title = "Danh sách người dùng";
    return view("admin.users.list", compact('users', 'title', 'message'));
  }

  public function create()
  {
    $title = "Thêm người dùng";
    return view("admin.users.add", compact('title'));
  }

  public function store()
  {
    $data = $_POST;
    unset($data['submitFormAddUser']);
    $user = new User;
    $user->create($data);
    $_SESSION['message'] = "Thêm mới người dùng thành công";
    header("location: " . ADMIN_URL . "?ctl=listusers");
  }

  public function edit()
  {
    $id = $_GET['id'];
    $user = (new User)->find($id);
    $title = "Cập nhật: " . $user['fullname'];
    return view("admin.users.edit", compact('user', 'title'));
  }

  public function update()
  {
    $data = $_POST;
    unset($data['submitFormUpdateUser']);
    $user = new User;
    $user->update($data['id'], $data);
    $_SESSION['message'] = "Cập nhật người dùng thành công";
    header("location: " . ADMIN_URL . "?ctl=edituser&id=" . $data['id']);
  }

  public function delete()
  {
    $id = $_GET['id'];
    (new User)->delete($id);
    $_SESSION['message'] = "Xóa người dùng thành công";
    header("location: " . ADMIN_URL . "?ctl=listuser");
  }
}
