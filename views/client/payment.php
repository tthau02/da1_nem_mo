<?php include_once ROOT_DIR . "views/client/header.php"; ?>
<?php

// // Nếu giỏ hàng trống và có thông tin sản phẩm từ GET
// if (empty($carts) && isset($_GET['id'])) {
//     // Lấy thông tin sản phẩm từ ID
//     $product = (new Product())->find($_GET['id']);

//     // Lưu thông tin sản phẩm vào session
//     if ($product) {
//         $_SESSION['product'] = [
//             'id' => $product['id'],
//             'name' => $product['name'],
//             'price' => $product['price']
//         ];
//     }
// }

?>

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
                    <form action="<?= ROOT_URL . '?ctl=checkout' ?>" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và Tên</label>
                            <input type="text" class="form-control" id="name" name="fullname" value="<?= $user['fullname'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa Chỉ</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?= $user['address'] ?>">
                            <?php if (!empty($error)): ?>
                                <span class="text-danger"><?= $error ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số Điện Thoại</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="<?= $user['phone'] ?>">
                            <?php if (!empty($error)): ?>
                                <span class="text-danger"><?= $error ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>">
                        </div>


                        <input type="hidden" value="<?= $user['id'] ?>" name="id">

                        <!-- Phương thức thanh toán -->
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                Phương Thức Thanh Toán
                            </div>
                            <div class="card-body">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment" id="cod" value="cod" checked>
                                    <label class="form-check-label" for="cod">
                                        Thanh toán khi nhận hàng (COD)
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment" id="vnpay" value="vnpay">
                                    <label class="form-check-label" for="vnpay">
                                        Thanh toán bằng VNPAY
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment" id="momo" value="momo">
                                    <label class="form-check-label" for="momo">
                                        Thanh toán bằng Momo
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success w-100 mt-4">Xác nhận thanh toán</button>
                    </form>
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
                    <ul class="list-group">
                        <?php
                        if (!empty($carts)) {
                            foreach ($carts as $cart) : ?>
                                <li class="d-flex justify-content-between mb-3">
                                    <div>
                                        <h6>Tên Sản Phẩm : <?= $cart['name'] ?></h6>
                                        <small>Số lượng: <?= $cart['quantity'] ?></small>
                                        <h6>Giá: <?= number_format($cart['price'] * $cart['quantity']) ?> VNĐ</h6>
                                    </div>
                                </li>
                        <?php endforeach;
                        } else {
                            // Nếu giỏ hàng trống, lấy giá sản phẩm từ session
                            if (isset($_SESSION['product'])) {
                                $product = $_SESSION['product'];
                                echo "<li class='d-flex justify-content-between mb-3'>
                                    <div>
                                        <h6>Tên Sản Phẩm: {$product['name']}</h6>
                                        <h6>Giá: " . number_format($product['price']) . " VNĐ</h6>
                                    </div>
                                  </li>";
                            }
                        }
                        ?>
                    </ul>


                    <!-- Tổng tiền -->
                    <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                        <strong>Tổng cộng</strong>
                        <strong><?php if (empty($carts)) {

                                    // Nếu giỏ hàng trống, hiển thị giá gốc của sản phẩm
                                    echo number_format($product['price'], 0, ',', '.') . ' VNĐ';
                                } else {
                                    // Nếu giỏ hàng không trống, hiển thị tổng giá trị giỏ hàng
                                    echo number_format($totalPrice, 0, ',', '.') . ' VNĐ';
                                }
                                ?></strong>

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<?php include_once ROOT_DIR . "views/client/footer.php"; ?>