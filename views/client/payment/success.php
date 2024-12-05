<?php include_once ROOT_DIR . "views/client/header.php"; ?>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6 text-center">
      <div class="card border-success">
        <div class="card-body">
          <i class="fas fa-check-circle text-success display-1 mb-4"></i>
          <h2 class="card-title text-success mb-3">Đặt Hàng Thành Công!</h2>
          <p class="card-text text-muted mb-4">
            Cảm ơn bạn đã mua hàng tại cửa hàng của chúng tôi! Đơn hàng của bạn đã được xác nhận và đang trong quá trình xử lý.
          </p>
          <p class="card-text text-muted">
            Mã đơn hàng: <strong><?php echo $order_id ?></strong>
          </p>
          <p class="card-text text-muted">
            Tổng tiền: <strong><?php echo number_format($total_price, 0, ',', '.') ?> VND</strong>
          </p>
          <a href="<?= ROOT_URL ?>" class="btn btn-primary mt-4">Về Trang Chủ</a>
        </div>

      </div>
    </div>
  </div>
</div>
<?php include_once ROOT_DIR . "views/client/footer.php"; ?>