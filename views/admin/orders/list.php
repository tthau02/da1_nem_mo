<?php include_once ROOT_DIR . "views/admin/sidebar.php" ?>
<div class="main">
    <?php include_once ROOT_DIR . "views/admin/header.php" ?>
    <!--danh sach danh muc-->
    <main class="container-fluid content px-3 py-4">
        <div class="shadow bg-white pb-5 mt-4 ms-4 mb-4 col-md-11" style="width: 96%;">
            <div>

                <h4 class="p-3">Danh sách đơn hàng</h4>

            </div>
            <hr>
            <div class="d-flex justify-content-between align-items-center">
                <form action="" class="ms-4">
                    <div class="input-group input-group-sm">
                        <input class="form-control rounded-0 mb-2 pb-2" type="search" id="search" name="search" placeholder="Nhập từ khóa tìm kiếm" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        <div class="input-group-sm">
                            <button type="button" class="btn btn-secondary rounded-0">
                                <i class="lni lni-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="pb-5 mt-4 ms-2 mb-4 ">
                <table class="table table-hover ">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col" class="text-center align-middle">ID người dùng</th>
                        <th scope="col" class="text-center align-middle">Trạng thái</th>
                        <th scope="col" class="text-center align-middle">Phương thức thanh toán</th>
                        <th scope="col" class="text-center align-middle">Tổng số tiền</th>
                        <th scope="col" class="text-center align-middle">Ngày mua</th>
                        <th scope="col" class="text-center align-middle">Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($orders as $order) : ?>

                            <tr>
                               
                                <td class="text-center align-middle"><?= $order['id'] ?></td>
                                <td class="text-center align-middle"><?= $order['user_id'] ?></td>
                                <td class="text-center align-middle"><?= getOrderStatus($order['status']) ?></td>
                                <td class="text-center align-middle"><?= $order['payment'] ?></td>
                                <td class="text-center align-middle"><?= number_format($order['total_price']) ?> VNĐ</td>
                                <td class="text-center align-middle"><?= $order['created_at'] ?></td>
                                

                                <td class="text-center align-middle">
                                    <a  href="<?= ADMIN_URL . '?ctl=detail-order&id=' . $order['id']?>">
                                    <button type="button" class="btn btn-outline-primary">
                                            <i class="lni lni-pencil"></i>
                                        </button>
                                    </a>
                                    
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

</div>
</main>
<!--end-->
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php" ?>