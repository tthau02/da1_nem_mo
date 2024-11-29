<?php include_once ROOT_DIR . "views/admin/sidebar.php" ?>
<div class="main">
    <?php include_once ROOT_DIR . "views/admin/header.php" ?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h4>Chi tiết đơn hàng</h4>
            </div>
            <div class="card-body">
                <!-- Thông tin đơn hàng -->
                <div class="mb-4">
                    <h5>Mã đơn hàng: #<?= $order['id'] ?></h5>
                    <p><strong>Ngày đặt hàng:</strong> <?= date('d-m-Y H:i:s', strtotime($order['created_at'])) ?></p>
                </div>

                <!-- Thông tin khách hàng -->
                <div class="mb-4">
                    <h5>Thông tin khách hàng</h5>
                    <p><strong>Họ tên:</strong> <?= $order['fullname'] ?></p>
                    <p><strong>Email:</strong> <?= $order['email'] ?></p>
                    <p><strong>Điện thoại:</strong> <?= $order['phone'] ?></p>
                    <p><strong>Địa chỉ:</strong> <?= $order['address'] ?></p>
                </div>

                <!-- Danh sách sản phẩm -->
                <div class="mb-4">
                    <h5>Danh sách sản phẩm</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sản phẩm</th>
                                <th>Ảnh</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($order_details as $stt => $detail) : ?>
                            <tr>
                                <td><?= $stt +1 ?></td>
                                <td><?= $detail['name'] ?></td>
                                <td>
                                    <img src="<?= ROOT_URL . $detail['image'] ?>" width="60" alt="">
                                </td>
                                <td><?= number_format($detail['price']) ?></td>
                                <td><?= $detail['quantity'] ?></td>
                                <td><?= number_format($detail['price'] * $detail['quantity']) ?> VNĐ</td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end">Tổng cộng:</th>
                                <th><?= number_format($order['total_price']) ?> VNĐ</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Cập nhật trạng thái đơn hàng -->
                <div class="mb-4">
                    <h5>Cập nhật trạng thái đơn hàng</h5>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="orderStatus" class="form-label">Trạng thái đơn hàng</label>
                            <select id="orderStatus" name="status" class="form-select">
                                <?php foreach($status as $key =>$value) : ?>
                                <option value="<?= $key ?>" <?= $order['status'] == $key ? 'selected' : '' ?>>
                                    <?= $value ?>
                                </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>

                <!-- Nút thao tác -->
                <div class="d-flex justify-content-between">
                    <a href="<?= ADMIN_URL . '?ctl=list-order' ?>" class="btn btn-secondary">Quay lại danh sách đơn hàng</a>

                </div>
            </div>
        </div>
    </div>
    
</div>


<?php include_once ROOT_DIR . "views/admin/footer.php" ?>