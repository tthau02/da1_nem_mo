<?php include_once ROOT_DIR . "views/client/header.php" ?>
<style>
        .order-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 20px;
        }
        .order-header {
            font-size: 15px;
            margin-bottom: 15px;
            color: #000;
        }
        .product-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
        }
        .product-info {
            margin-left: 20px;
        }
        .badge-status {
            font-size: 14px;
        }
        .total-price {
            font-weight: bold;
            color: #198754;
        }
    </style>


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
                <div class="card p-4">
                <?php
                    $statusColors = [
                        1 => ['text' => 'Chờ xử lý', 'color' => 'bg-warning'], 
                        2 => ['text' => 'Đang xử lý', 'color' => 'bg-primary'], 
                        3 => ['text' => 'Đã hoàn thành', 'color' => 'bg-success'],
                        4 => ['text' => 'Đã huỷ', 'color' => 'bg-danger'],
                    ];

                    foreach ($orderDetails as $order) {
                        $orderStatus = $statusColors[$order['status']] ?? ['text' => 'Không xác định', 'color' => 'bg-secondary'];
                        ?>
                        <div class="order-card">
                            <div class="order-header">
                                Đơn Hàng: #<?= $order['order_id'] ?> 
                                <span class="badge <?= $orderStatus['color'] ?>"><?= $orderStatus['text'] ?></span>
                            </div>
                            <div class="d-flex align-items-center">
                                <a href="<?= ROOT_URL . "?ctl=detail&id=" . $order['product_id']; ?>">
                                <img src="<?= ROOT_URL . $order['product_image'] ?>" alt="Sản phẩm" class="product-img">
                                </a>
                                <div class="product-info">
                                    <h6><?= $order['product_name'] ?></h6>
                                    <p>Số lượng: <?= $order['quantity'] ?></p>
                                    <p>
                                        Giá: <strong><?= number_format($order['product_price'], 0, ',', '.'); ?> VND</strong>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span>Tổng cộng: <strong><?= number_format($order['total_price'], 0, ',', '.'); ?> VND</strong></span>
                                <div class="d-flex">
                                    <?php 
                                        if(in_array($order['status'], [3, 4])){
                                            ?>
                                                <a href="<?= ROOT_URL . '?ctl=add-cart&id=' . $order['product_id'] ?>" class="btn btn-danger btn-sm text-white me-2">Mua Lại</a>
                                            <?php
                                        }
                                    ?>
                                    <a href="?ctl=detail-order&order_id=<?= $order['order_id'] ?>" class="btn btn-primary btn-sm text-white me-2">Xem Chi Tiết</a>
                                    <?php if (in_array($order['status'], [1, 2])): // Kiểm tra trạng thái ?>
                                        <form method="POST" action="?ctl=cancel-order&id=<?= $order['order_id'] ?>">
                                            <button type="submit" class="btn btn-warning btn-sm text-white">Hủy Đơn Hàng</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>


<?php include_once ROOT_DIR . "views/client/footer.php" ?>