<?php include_once ROOT_DIR . "views/client/header.php"; ?>
<div class="container mt-5">
    <h1 class="text-success text-center mb-4">Giỏ hàng của bạn</h1>

    <?php if (empty($carts)) : ?>
        <div class="alert alert-warning text-center" role="alert">
            Giỏ hàng của bạn đang trống. <a href="<?= ROOT_URL ?>" class="alert-link">Tiếp tục mua sắm</a>.
        </div>
    <?php else : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-success text-center">
                    <tr>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Đơn giá</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Thành tiền</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($carts as $id => $cart): ?>
                        <tr>
                            <td class="text-center">
                                <img src="<?= $cart['image'] ?>" alt="<?= $cart['name'] ?>" class="img-fluid rounded" style="width: 80px; height: auto;">
                            </td>
                            <td class="text-center"><?= $cart['name'] ?></td>
                            <td class="text-center text-primary"><?= number_format($cart['price'], 0, ',', '.') ?>đ</td>
                            <td class="text-center"><?= $cart['quantity'] ?></td>
                            <td class="text-center text-danger"><?= number_format($cart['price'] * $cart['quantity'], 0, ',', '.') ?>đ</td>
                            <td class="text-center">
                                <a class="btn btn-danger btn-sm" href="?ctl=removeCart&id=<?= $id ?>">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="text-end">
            <p class="fs-5"><strong>Tổng số lượng:</strong> <?= $totalQuantity ?></p>
            <p class="fs-5"><strong>Tổng tiền:</strong> <span class="text-danger"><?= number_format($totalPrice, 0, ',', '.') ?>đ</span></p>
            <div class="d-flex justify-content-end gap-2">
                <a class="btn btn-success" href="<?= ROOT_URL . "?ctl=payCart" ?>">Thanh Toán</a>
                <a class="btn btn-secondary" href="<?= ROOT_URL ?>">Tiếp tục mua sắm</a>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php include_once ROOT_DIR . "views/client/footer.php"; ?>
