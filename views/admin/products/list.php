<?php include_once ROOT_DIR . "views/admin/sidebar.php" ?>
<div class="main">
    <?php include_once ROOT_DIR . "views/admin/header.php" ?>
    <!--danh sach danh muc-->
    <main class="container-fluid content px-3 py-4">
        <div class="shadow bg-white pb-5 mt-4 ms-4 mb-4 col-md-11" style="width: 96%;">
            <div>
                <h4 class="p-3">Danh sách sản phẩm</h4>
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
                            <th scope="col" class="text-center align-middle"></th>
                            <th scope="col" class="text-center align-middle">#ID</th>
                            <th scope="col" class="text-center align-middle">Name</th>
                            <th scope="col" class="text-center align-middle">Image</th>
                            <th scope="col" class="text-center align-middle">Price</th>
                            <th scope="col" class="text-center align-middle">Quantity</th>
                            <th scope="col" class="text-center align-middle">Status</th>
                            <th scope="col" class="text-center align-middle">Category</th>
                            <th scope="col" class="text-center align-middle">Description</th>
                            <th scope="col" class="text-center align-middle">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $pro) : ?>
                            <tr>
                                <td scope="row" class="text-center align-middle">
                                    <form action="" method="post">
                                        <input type="checkbox">
                                    </form>
                                </td>
                                <td class="text-center align-middle"><?= $pro['id'] ?></td>
                                <td class="text-center align-middle"><?= $pro['name'] ?></td>
                                <td class="text-center align-middle image-product">
                                    <img src="<?= ROOT_URL . $pro['image'] ?>" class="img-thumbnail" alt="">
                                </td>
                                <td class="text-center align-middle"><?= $pro['price'] ?></td>
                                <td class="text-center align-middle"><?= $pro['quantity'] ?></td>
                                <td class="text-center align-middle"><?= $pro['status'] ? 'Đang kinh doanh' : 'Ngừng kinh doanh' ?></td>
                                <td class="text-center align-middle"><?= $pro['cate_name'] ?></td>
                                <td class="text-center align-middle">
                                    <div style="max-height: 150px; overflow-y: auto; display: block;">
                                        <?= $pro['description'] ?>
                                    </div>
                                </td>
                                <td class="text-center align-middle">
                                    <a href="<?= ADMIN_URL . '?ctl=editsp&id=' . $pro['id'] ?>">
                                        <button type="button" class="btn btn-outline-primary">
                                            <i class="lni lni-pencil"></i>
                                        </button>
                                    </a>
                                    <a onclick="return confirm ('Bạn có chắc chắn muốn xóa danh mục này không!')" href="<?= ADMIN_URL . '?ctl=deletesp&id=' . $pro['id'] ?>">
                                        <button type="button" class="btn btn-outline-danger">
                                            <i class="lni lni-close"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

            <form class="pb-5 mt-4 ms-4 mb-4 col-md-11">
                <button type="submit" class="btn btn-info text-light">Chọn tất cả</button>
                <button type="submit" class="btn btn-info"><a href="?ctl=addsp" class="text-light">Nhập thêm</a></button>
            </form>
        </div>

</div>
</main>
<!--end-->
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php" ?>