<?php include ROOT_DIR . "views/admin/sidebar.php"; ?>
<div class="main">
    <?php include ROOT_DIR . "views/admin/header.php" ?>
    <!--danh sach danh muc-->
    <main class="container-fluid content px-3 py-4">
        <div class="shadow bg-white pb-5 mt-4 ms-4 mb-4 col-md-11" style="width: 96%;">
            <div>
                <h4 class="p-3">Cập nhật danh mục</h4>
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
                <input type="hidden" name="id" value="<?= $category['id'] ?>">
                <div class="form-group">
                    <label for="cate_name">Tên danh mục</label>
                    <input type="text" class="form-control mt-2 mb-3" name="cate_name" required value="<?= $category['cate_name'] ?>">
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

<?php include "views/components/footer.php" ?>