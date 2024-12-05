<?php
include_once ROOT_DIR . "views/client/header.php";
?>
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6 text-center">
      <div class="card border-danger">
        <div class="card-body">
          <i class="fas fa-times-circle text-danger display-1 mb-4"></i>
          <h2 class="card-title text-danger mb-3">Đặt Hàng Thất Bại!</h2>
          <p class="card-text text-muted mb-4">
            Rất tiếc! Đã xảy ra lỗi khi xử lý giao dịch của bạn.
          </p>
          <a href="<?= ROOT_URL ?>/cart" class="btn btn-danger mt-4">Thử Lại</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once ROOT_DIR . "views/client/footer.php"; ?>