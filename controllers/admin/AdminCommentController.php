<?php

class AdminCommentController {
    public function index()
    {
        $title = "List sản phẩm";
        $comments = (new Comment)->all();
        return view("admin.comment.list", compact('comments', 'title'));
    }

    public function delete()
  {
    $id = $_GET['id'];
    (new Comment)->delete($id);
    header("location: " . ADMIN_URL . "?ctl=listcomment");
  }
}

?>