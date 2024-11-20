<?php include_once ROOT_DIR . "views/client/header.php" ?>

<h1>Đây trang profile</h1>
<?php
if (isset($_SESSION['success_message'])) {
  echo '<div class="alert alert-success" role="alert">' . $_SESSION['success_message'] . '</div>';
  unset($_SESSION['success_message']);
}
if (isset($_SESSION['error_message'])) {
  echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
  unset($_SESSION['error_message']);
}
?>
<form action="<?= ROOT_URL . '?ctl=updateUser' ?>" method="post">
  <input type="hidden" name="id" value="<?= $user['id'] ?>">
  <div class="form-group
    ">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>">
  </div>
  <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>


<?php include_once ROOT_DIR . "views/client/footer.php" ?>