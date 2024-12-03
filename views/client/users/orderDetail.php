<?php include_once ROOT_DIR . "views/client/header.php" ?>

<div class="container mt-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="<?= ROOT_URL . $user['image'] ?>" alt="User Avatar" class="rounded-circle img-fluid mb-3" style="width: 160px; height: 160px;">
                        <h6 class="card-title"><?= $user["fullname"] ?></h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="?ctl=edit-profile" class="text-decoration-none"><i class="fa fa-user"></i> Thông tin cá nhân</a>
                        </li>
                        <li class="list-group-item">
                            <a href="?ctl=list-order" class="text-decoration-none"><i class="fa fa-shopping-cart"></i> Lịch sửa mua hàng</a>
                        </li>
                        <li class="list-group-item">
                            <a href="<?= ROOT_URL . '?ctl=logout' ?>" class="text-decoration-none"><i class="fa fa-sign-out-alt"></i> Đăng Xuất</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-10">
            <div class="order-detail-card bg-light p-4 shadow-sm rounded">
                    <h3 class="text-center mb-4">Chi Tiết Đơn Hàng</h3>
                        <div class="order-info mb-3">
                            <p><strong>Mã Đơn Hàng:</strong> #<?= $order['id'] ?></p>
                            <p><strong>Ngày Đặt Hàng:</strong> <?= date('d-m-Y H:i:s', strtotime($order['created_at'])) ?></p>
                            <p><strong>Người mua: <?= $order['fullname']?></strong> </p>
                            <p><strong>Số điện thoại: <?= $order['phone'] ?></strong> </p>
                            <p><strong>Đại chỉ giao hàng: <?= $order['address'] ?></strong> </p>
                            <p><strong>Phương Thức Thanh Toán:</strong> Thanh toán khi nhận hàng</p>
                        </div>
                        <hr>
                        <h5 class="mb-3">Danh Sách Sản Phẩm:</h5>
                        <div class="order-products">
                            <?php foreach ($order_details as $product): ?>
                                <div class="d-flex align-items-center border-bottom pb-3 mb-3">
                                    <img src="<?= ROOT_URL . $product['image'] ?>" alt="<?= $product['name'] ?>" 
                                        class="img-fluid rounded me-3" style="width: 100px; height: 100px;">
                                    <div class="product-details">
                                        <h6 class="mb-1"><?= $product['name'] ?></h6>
                                        <p class="mb-1">Số Lượng: <?= $product['quantity'] ?></p>
                                        <p class="mb-1">Giá: <strong><?= number_format($product['price'], 0, ',', '.') ?> VND</strong></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <hr>
                        <div class="order-total text-end">
                            <h6><strong>Tổng Cộng: <?= number_format($order['total_price'], 0, ',', '.') ?> VND</strong></h6>
                        </div>
                        <div class="text-center mt-4">
                            <a href="?ctl=list-order" class="btn btn-secondary btn-sm">Quay Lại</a>
                            <a href="?ctl=contact" class="btn btn-primary btn-sm">Liên Hệ Hỗ Trợ</a>
                        </div>
                </div>

            </div>
        </div>
    </div>


<?php include_once ROOT_DIR . "views/client/footer.php" ?>