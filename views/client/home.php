<?php include_once ROOT_DIR . "views/client/header.php" ?>
<?php include_once ROOT_DIR . "views/client/banner.php" ?>

<section class="section-specials padding-y border-bottom mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <figure class="itemside">
                    <div class="aside">
                        <span class="icon-sm rounded-circle bg-primary">
                            <i class="fa fa-money-bill-alt white"></i>
                        </span>
                    </div>
                    <figcaption class="info">
                        <h6 class="title">Giá cả hợp lý</h6>
                        <p class="text-muted">Chúng tôi cam kết cung cấp sản phẩm giá cả hợp lý </p>
                    </figcaption>
                </figure> <!-- iconbox // -->
            </div><!-- col // -->
            <div class="col-md-4">
                <figure class="itemside">
                    <div class="aside">
                        <span class="icon-sm rounded-circle bg-danger">
                            <i class="fa fa-comment-dots white"></i>
                        </span>
                    </div>
                    <figcaption class="info">
                        <h6 class="title">Hỗ trợ khách hàng 24/7 </h6>
                        <p class="text-muted">Luôn luôn sẵn sàng phục vụ khách hàng bất kể thời gian nào </p>
                    </figcaption>
                </figure>
            </div><!-- col // -->
            <div class="col-md-4">
                <figure class="itemside">
                    <div class="aside">
                        <span class="icon-sm rounded-circle bg-success">
                            <i class="fa fa-truck white"></i>
                        </span>
                    </div>
                    <figcaption class="info">
                        <h6 class="title">Chuyển phát nhanh</h6>
                        <p class="text-muted">Giao hàng thần tốc - Giao hàng trong vòng 24h</p>
                    </figcaption>
                </figure> <!-- iconbox // -->
            </div><!-- col // -->
        </div> <!-- row.// -->

    </div> <!-- container.// -->
</section>

<section class="container mt-6">
  <div class="card border-0">
    <div class="card-header bg-success text-white text-uppercase text-center">
        Danh Mục Nổi Bật
    </div>
    <div class="product-slider">
      <?php
            foreach ($categories as $category){
                ?>
                    <div class="card">
                        <img src="<?= ROOT_URL . $category["image"] ?>" class="card-img-top" alt="Product 1">
                        <div class="card-body">
                        <h5 class="card-title"><?= $category["cate_name"] ?></h5>
                        </div>
                    </div>
                <?php
            }
      ?>
    <!-- Thêm các sản phẩm khác ở đây -->
  </div>
</div>
</section>

<section class="banner-sale container">
  <div class="sale-item">
    <div class="ad-box position-relative">
      <img src="https://everon.com/upload/upload-images/esc22018-everon-solid-2021.jpg" alt="Quảng cáo" class="ad-image">
      <div class="ad-content text-center text-white">
        <h3 class="ad-title">Khuyến mãi đặc biệt</h3>
        <p class="ad-text">Nhận ưu đãi ngay hôm nay!</p>
        <a href="#" class="btn btn-outline-success">Mua ngay</a>
      </div>
    </div>
  </div>
  <div class="">
    <div class="ad-box position-relative">
      <img src="https://everon.com/upload/upload-images/esc22018-everon-solid-2021.jpg" alt="Quảng cáo" class="ad-image">
      <div class="ad-content text-center text-white">
        <h3 class="ad-title">Khuyến mãi đặc biệt</h3>
        <p class="ad-text">Nhận ưu đãi ngay hôm nay!</p>
        <a href="#" class="btn btn-outline-success">Mua ngay</a>
      </div>
    </div>
  </div>
</section>

      
  <!-- Sản phẩm mởi nhất -->
  <section class="last-product">
    <div class="container mt-6">
        <div class="row">
            <div class="col-sm">
                <div class="card border-0">
                    <div class="card-header bg-success text-white text-uppercase text-center">
                        Sản phẩm mới nhất
                    </div>
                    <div class="card-body">
                    <div class="row">
                            <?php foreach ($newProduct as $product): ?>
                                <div class="col-md-3 mb-4">
                                    <div class="card shadow-sm">
                                        <img
                                            src="<?= ROOT_URL . $product['image']; ?>"
                                            class="card-img-top"
                                            alt="<?= htmlspecialchars($product['name']); ?>"
                                            style="height: 200px; object-fit: cover;">
                                        <div class="card-body">
                                            <h5 class="card-title text-truncate"><?= $product['name']; ?></h5>
                                            <p class="card-text text-muted">
                                                Giá: <strong><?= number_format($product['price'], 0, ',', '.'); ?> VND</strong>
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="<?= ROOT_URL . "?ctl=detail&id=" . $product['id']; ?>" class="btn btn-primary btn-sm">
                                                    Xem chi tiết
                                                </a>
                                                <a href="cart.html" class="btn btn-primary btn-sm">+ Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="text-center mt-4">
                            <a href="?ctl=product" class="btn btn-outline-danger ">Xem tất cả  >></a>
                        </div>
                    </div>

                </div>
            </section>  

<?php include_once ROOT_DIR . "views/client/footer.php" ?>