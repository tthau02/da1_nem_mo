<?php
include_once ROOT_DIR . "views/client/header.php";
?>
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6 text-center">
      <div class="card border-warning">
        <div class="card-body">
          <i class="fas fa-exclamation-circle text-warning display-1 mb-4"></i>
          <h2 class="card-title text-warning mb-3">Yêu Cầu Không Hợp Lệ!</h2>
          <p class="card-text text-muted mb-4">
            Rất tiếc, giao dịch của bạn không hợp lệ hoặc đã hết hạn.
          </p>
          <a href="<?= ROOT_URL ?>" class="btn btn-warning mt-4">Về Trang Chủ</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once ROOT_DIR . "views/client/footer.php"; ?>