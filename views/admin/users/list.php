<?php include_once ROOT_DIR . "views/admin/sidebar.php" ?>
<div class="main">
    <?php include_once ROOT_DIR . "views/admin/header.php" ?>
    <!--danh sach nguoi dung-->
    <main class="container-fluid content px-3 py-4">
        <div class="shadow bg-white pb-5 mt-4 ms-4 mb-4 col-md-11" style="width: 96%;">
            <div>
                <h4 class="p-3">Danh sách người dùng</h4>
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
                            <th scope="col" class="text-center align-middle">ID</th>
                            <th scope="col" class="text-center align-middle">Họ và tên</th>
                            <th scope="col" class="text-center align-middle">Tên đăng nhập</th>
                            <th scope="col" class="text-center align-middle">Email</th>
                            <th scope="col" class="text-center align-middle">Số điện thoại</th>
                            <th scope="col" class="text-center align-middle">Địa chỉ</th>
                            <th scope="col" class="text-center align-middle">Vai trò</th>
                            <th scope="col" class="text-center align-middle"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($users as $user) {
                        ?>
                            <tr>
                                <th scope="row" class="text-center align-middle">
                                    <form action="" method="post">
                                        <input type="checkbox">
                                    </form>
                                </th>
                                <td class="text-center align-middle"><?= $user['id'] ?></td>
                                <td class="text-center align-middle"><?= $user['fullname'] ?></td>
                                <td class="text-center align-middle"><?= $user['username'] ?></td>
                                <td class="text-center align-middle"><?= $user['email'] ?></td>
                                <td class="text-center align-middle"><?= $user['phone'] ?></td>
                                <td class="text-center align-middle"><?= $user['address'] ?></td>
                                <td class="text-center align-middle"><?= $user['role'] ?></td>
                                <td class="text-center align-middle">
                                    <a href="?ctl=edituser&id=<?= $user['id']; ?>">
                                        <button type="button" class="btn btn-outline-primary">
                                            <i class="lni lni-pencil"></i>
                                        </button>
                                    </a>
                                    <a onclick="return confirm ('Bạn có chắc chắn muốn xóa người dùng này không!')" href="?ctl=deleteuser&id=<?= $user['id'] ?>">
                                        <button type="button" class="btn btn-outline-danger">
                                            <i class="lni lni-close"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <form class="pb-5 mt-4 ms-4 mb-4 col-md-11">
                <button type="submit" class="btn btn-info text-light">Chọn tất cả</button>
                <button type="submit" class="btn btn-info"><a href="?ctl=adduser" class="text-light">Nhập thêm</a></button>
            </form>
        </div>

</div>
</main>
<!--end-->
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php" ?>