<?php include_once ROOT_DIR . "views/client/header.php"; ?>


<div class="container my-5">
    <h2 class="text-center mb-4">Thanh Toán</h2>
    <div class="row">
        <!-- Thông tin giao hàng -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Thông Tin Giao Hàng
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và Tên</label>
                            <input type="text" class="form-control" id="name" value="<?= $user['fullname'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa Chỉ</label>
                            <input type="text" class="form-control" id="address" value="<?= $user['address'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số Điện Thoại</label>
                            <input type="tel" class="form-control" id="phone" value="<?= $user['phone'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="<?= $user['email'] ?>">
                        </div>
                    </form>
                </div>
            </div>

            <!-- Phương thức thanh toán -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Phương Thức Thanh Toán
                </div>
                <div class="card-body">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="cod" value="cod" checked>
                        <label class="form-check-label" for="cod">
                            Thanh toán khi nhận hàng (COD)
                        </label>
                    </div>
                    
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="vnpay" value="vnpay">
                        <label class="form-check-label" for="vnpay">
                            Thanh toán bằng VNPAY
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Đơn hàng -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Thông tin giỏ hàng
                </div>
                <div class="card-body">
                    <!-- Sản phẩm -->
                     <ul class="list-group"></ul>
                     <?php foreach($carts as $cart) : ?>
                    <li class="d-flex justify-content-between mb-3">
                        <div>
                            <h6>Tên Sản Phẩm : <?= $cart['name'] ?></h6>
                            <small>Số lượng: <?= $cart['quantity'] ?></small>
                        </div>
                        <span><?= number_format($cart['price'] * $cart['quantity']) ?></span>
                    </li>
                    <?php endforeach ?>
                    </ul>

                    <!-- Tổng tiền -->
                    <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                        <strong>Tổng cộng</strong>
                        <strong><?= number_format($totalPrice, 0, ',', '.') ?>VNĐ</strong>
                    </div>
                </div>
            </div>

            <!-- Nút đặt hàng -->
            <a href="./thanhtoanthanhcong.html"><button class="btn btn-success w-100 mt-4">Xác nhận thanh toán</button></a>
        </div>
    </div>
</div>

<?php include_once ROOT_DIR . "views/client/footer.php"; ?>