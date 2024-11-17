<?php include_once ROOT_DIR . "views/admin/sidebar.php" ?>
<div class="main">
    <?php include_once ROOT_DIR . "views/admin/header.php" ?>
    <!--danh sach sản phẩm-->
    <main class="container-fluid content px-3 py-4">
        <div class="shadow bg-white pb-5 mt-4 ms-4 mb-4 col-md-11" style="width: 96%;">
            <div>
                <h4 class="p-3">Thêm sản phẩm</h4>
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
            <form action="<?= ADMIN_URL . '?ctl=storesp' ?>" class="pb-5 mt-4 ms-4 mb-4 col-md-11"  method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input type="text" class="form-control mt-2 mb-3" name="name" required>
                </div>
                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select name="category_id" id="" class="form-control mt-2 mb-3">
                        <?php foreach ($categories as $cate): ?>
                            <option value="<?= $cate['id'] ?>">
                                <?= $cate['cate_name'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Hình ảnh</label>
                    <input type="file" class="form-control mt-2 mb-3" name="image">
                </div>
                <div class="form-group">
                    <label for="price">Giá</label>
                    <input type="number" class="form-control mt-2 mb-3" name="price">
                </div>
                <div class="form-group">
                    <label for="quantity">Số lượng</label>
                    <input type="number" class="form-control mt-2 mb-3" name="quantity">
                </div>
                <div class="form-group">
                    <label for="status">Trạng thái</label>
                    <input type="radio" name="status" value="1" checked> Đang kinh doanh
                    <input type="radio" name="status" value="0"> Ngừng kinh doanh
                </div>
                <div class="form-group mt-3">
                    <label for="description">Mô tả</label>
                    <textarea name="description" rows="6" class="form-control mt-2 mb-3"></textarea>
                </div>


                <button type="submit" class="btn btn-info text-light" name="submitFormAddProduct">Thêm mới</button>
                <button type="reset" class="btn btn-secondary text-light">Nhập lại</button>
                <a href="?ctl=listsp" class="btn btn-info text-light">Danh sách</a>

                <?php if (isset($successMessage)): ?>
                    <div class="alert alert-success mt-3" role="alert">
                        <?= htmlspecialchars($successMessage); ?>
                    </div>
                <?php elseif (isset($errorMessage)): ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        <?= htmlspecialchars($errorMessage); ?>
                    </div>
                <?php endif; ?>
            </form>

        </div>

</div>
</main>
<!--end-->
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php" ?>