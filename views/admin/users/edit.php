<?php include ROOT_DIR . "views/admin/sidebar.php"; ?>
<div class="main">
    <?php include ROOT_DIR . "views/admin/header.php" ?>
    <!--danh sach danh muc-->
    <main class="container-fluid content px-3 py-4">
        <div class="shadow bg-white pb-5 mt-4 ms-4 mb-4 col-md-11" style="width: 96%;">
            <div>
                <h4 class="p-3">Cập nhật người dùng</h4>
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
            <form action="<?= ADMIN_URL . '?ctl=updatedm' ?>" class="pb-5 mt-4 ms-4 mb-4 col-md-11" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                <div class="form-group">
                    <label for="cate_name">Full name</label>
                    <input type="text" class="form-control mt-2 mb-3" name="fullname"  value="<?= $user['fullname'] ?>">
                </div>
                <div class="form-group">
                    <label for="cate_name">Username</label>
                    <input type="text" class="form-control mt-2 mb-3" name="username"  value="<?= $user['username'] ?>">
                </div>
                <div class="form-group">
                    <label for="cate_name">Email</label>
                    <input type="text" class="form-control mt-2 mb-3" name="email"  value="<?= $user['email'] ?>">
                </div>
                <div class="form-group">
                    <label for="cate_name">SĐT</label>
                    <input type="text" class="form-control mt-2 mb-3" name="phone"  value="<?= $user['phone'] ?>">
                </div>
                <div class="form-group">
                    <label for="cate_name">Đại chỉ</label>
                    <input type="text" class="form-control mt-2 mb-3" name="address"  value="<?= $user['address'] ?>">
                </div>
                <div class="form-group">
                    <label for="cate_name">Vai trò</label>
                    <input type="text" class="form-control mt-2 mb-3" name="role"  value="<?= $user['role'] ?>">
                </div>
                <div class="form-group">
                    <label for="image">Hình ảnh</label>
                    <input type="file" class="form-control mt-2 mb-3" name="image">
                    <?php if (!empty($category['image'])): ?>
                        <img src="<?= ROOT_URL . $category['image'] ?>" alt="Hình ảnh danh mục" class="img-thumbnail m-2" style="max-width: 200px; height: auto;">
                    <?php else: ?>
                        <p>Chưa có hình ảnh</p>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-info text-light" name="submitFormUpdateCategory">Cập nhật</button>
                <button type="reset" class="btn btn-secondary text-light">Nhập lại</button>
                <a href="<?= ADMIN_URL . '?ctl=listdm' ?>" class="btn btn-info text-light">Danh sách</a>

                <?php
                    if (isset($_SESSION['message'])) {
                        echo "<div class='alert alert-success mt-2'>" . $_SESSION['message'] . "</div>";
                        unset($_SESSION['message']); 
                    }
                ?>
            </form>


        </div>

</div>
</main>
<!--end-->
</div>
<?php include_once ROOT_DIR . "views/admin/footer.php" ?>