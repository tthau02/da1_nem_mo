<?php

class CommentController
{
  // Xử lý thêm comment mới
  public function addComment()
  {
    // URL để chuyển hướng khi có lỗi hoặc thành công
    $redirectUrl = $_SERVER['HTTP_REFERER'];

    // 1. Kiểm tra người dùng đã đăng nhập chưa
    if (empty($_SESSION['user_id'])) {
      $_SESSION['error_message_comment'] = "Bạn chưa đăng nhập!";
      header("Location: $redirectUrl");
      exit();
    }

    // 2. Kiểm tra người dùng đã mua sản phẩm chưa
    $userId = $_SESSION['user_id'];
    $productId = $_POST['product_id'] ?? null;

    if (empty($productId)) {
      $_SESSION['error_message_comment'] = "Không xác định được sản phẩm!";
      header("Location: $redirectUrl");
      exit();
    }

    $order = (new Order())->getOrderByUserIdAndProductId($userId, $productId);
    if (empty($order)) {
      $_SESSION['error_message_comment'] = "Bạn chưa mua sản phẩm này!";
      header("Location: $redirectUrl");
      exit();
    }

    // 3. Kiểm tra dữ liệu POST
    $comment = $_POST['comment'] ?? null;
    $rating = $_POST['rating'] ?? null;

    if (empty($comment) || empty($rating)) {
      $_SESSION['error_message_comment'] = "Vui lòng nhập đầy đủ thông tin bình luận.";
      header("Location: $redirectUrl");
      exit();
    }

    // 4. Chuẩn bị dữ liệu để thêm bình luận
    $data = [
      'product_id' => $productId,
      'comment' => $comment,
      'rating' => $rating,
      'user_id' => $userId,
      'status' => 1, // Mặc định là hiển thị
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s'),
    ];

    // 5. Thêm bình luận vào cơ sở dữ liệu
    $commentModel = new Comment();
    $commentModel->create($data);

    // 6. Gửi thông báo thành công và chuyển hướng
    $_SESSION['message'] = "Thêm mới bình luận thành công.";
    header("Location: $redirectUrl");
    exit();
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
