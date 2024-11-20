<?php

class CommentController
{
  // Xử lý thêm comment mới
  public function addComment()
  {
    // Kiểm tra nếu dữ liệu POST không đầy đủ
    if (empty($_POST['product_id']) || empty($_POST['comment']) || empty($_POST['rating'])) {
      $_SESSION['error_message'] = "Vui lòng nhập đầy đủ thông tin bình luận";
      header("location: " . $_SERVER['HTTP_REFERER']);
      return;
    }

    $data['product_id'] = $_POST['product_id'];
    $data['comment'] = $_POST['comment'];
    $data['rating'] = $_POST['rating'];
    $data['user_id'] = $_SESSION['user_id']; // Giả sử user_id được lưu trong session khi người dùng đăng nhập
    $data['status'] = 1; // Mặc định là hiển thị
    $data['created_at'] = date('Y-m-d H:i:s');
    $data['updated_at'] = date('Y-m-d H:i:s');

    $comment = new Comment;
    $comment->create($data);
    $_SESSION['message'] = "Thêm mới bình luận thành công";
    header("location: " . $_SERVER['HTTP_REFERER']);
  }

  // Xử lý chỉnh sửa comment
  public function editComment()
  {
    // Kiểm tra nếu dữ liệu POST không đầy đủ
    if (empty($_POST['id']) || empty($_POST['comment']) || empty($_POST['rating'])) {
      $_SESSION['error_message'] = "Vui lòng nhập đầy đủ thông tin bình luận";
      header("location: " . $_SERVER['HTTP_REFERER']);
      return;
    }

    $data = $_POST;
    $id = $data['id'];
    $comment = (new Comment)->find($id);

    // Kiểm tra nếu người dùng hiện tại là chủ sở hữu của bình luận
    if ($comment['user_id'] != $_SESSION['user_id']) {
      $_SESSION['error_message'] = "Bạn không có quyền chỉnh sửa bình luận này";
      header("location: " . $_SERVER['HTTP_REFERER']);
      return;
    }

    $data['updated_at'] = date('Y-m-d H:i:s');
    unset($data['submitFormUpdateComment']);
    $comment = new Comment;
    $comment->update($id, $data);
    $_SESSION['message'] = "Cập nhật bình luận thành công";
    header("location: " . $_SERVER['HTTP_REFERER']);
  }

  // Xóa comment
  public function delete()
  {
    $id = $_GET['id'];
    $comment = (new Comment)->find($id);

    // Kiểm tra nếu người dùng hiện tại là chủ sở hữu của bình luận
    if ($comment['user_id'] != $_SESSION['user_id']) {
      $_SESSION['error_message'] = "Bạn không có quyền xóa bình luận này";
      header("location: " . $_SERVER['HTTP_REFERER']);
      return;
    }

    (new Comment)->delete($id);
    $_SESSION['message'] = "Xóa bình luận thành công";
    header("location: " . $_SERVER['HTTP_REFERER']);
  }
}
