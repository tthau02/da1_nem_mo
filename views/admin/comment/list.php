<?php include_once ROOT_DIR . "views/admin/sidebar.php" ?>
<div class="main">
    <?php include_once ROOT_DIR . "views/admin/header.php" ?>
    <!--danh sach danh muc-->
    <main class="container-fluid content px-3 py-4">
        <div class="shadow bg-white pb-5 mt-4 ms-4 mb-4 col-md-11" style="width: 96%;">
            <div>
                <h4 class="p-3">Danh sách bình luận</h4>
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
                            <th scope="col" class="text-center align-middle">ID sản phẩm</th>
                            <th scope="col" class="text-center align-middle">Người dùng</th>
                            <th scope="col" class="text-center align-middle">Nội dung</th>
                            <th scope="col" class="text-center align-middle">Đánh giá</th>
                            <th scope="col" class="text-center align-middle">Ngày bình luận</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($comments as $comment) : ?>
                            <tr>
                                <td scope="row" class="text-center align-middle">
                                    <form action="" method="post">
                                        <input type="checkbox">
                                    </form>
                                </td>
                                <td class="text-center align-middle"><?= $comment['id'] ?></td>
                                <td class="text-center align-middle"><?= $comment['product_id'] ?></td>
                                <td class="text-center align-middle"><?= $comment['username'] ?></td>
                                <td class="text-center align-middle"><?= $comment['comment'] ?></td>
                                <td class="text-center align-middle" style="color: green; font-size:14px; font-weight: bold;">
                                        <?php for ($i = 1; $i <= $comment['rating']; $i++): ?>
                                        <span class="star filled">&#9733;</span>
                                         <?php endfor; ?>
                                </td>

                                <td class="text-center align-middle"><?= $comment['created_at'] ?></td>

                                <td class="text-center align-middle">
                                    <a onclick="return confirm ('Bạn có chắc chắn muốn xóa bình luận này không!')" href="?ctl=deletecomment&id=<?= $comment['id'] ?>">
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
        </div>

</div>
</main>
<!--end-->
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php" ?>