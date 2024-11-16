<?php include_once ROOT_DIR . "views/admin/sidebar.php" ?>
<div class="main">
    <?php include_once ROOT_DIR . "views/admin/header.php" ?>
    <!--danh sach sản phẩm-->
    <main class="container-fluid content px-3 py-4">
        <div class="shadow bg-white pb-5 ps-4 mt-4 ms-2 mb-4 col-md-11" style="width: 96%;">
            <div>
                <h4 class="p-3">Cập nhật sản phẩm</h4>
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
            <form action="<?= ADMIN_URL . '?ctl=updatesp' ?> class=" pb-5 mt-4 ms-4 mb-4 col-md-11" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="productName">Tên sản phẩm</label>
                    <input type="text" class="form-control mt-2 mb-3" name="name" value="<?= $product['name'] ?>"">
                </div>
                <div class=" form-group">
                    <label for="">Hình ảnh</label><br>
                    <img src="<?= ROOT_URL . $product['image'] ?>" width="60" alt=""> <br>
                    <input type="file" name="image" id="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Giá</label>
                    <input type="number" class="form-control mt-2 mb-3" name="price" value="<?= $product['price'] ?>">
                </div>

                <div class="form-group">
                    <label for="productDesc">Số lượng</label>
                    <input type="number" class="form-control mt-2 mb-3" name="quantity" value="<?= $product['quantity'] ?>">

                </div>
                <div class="form-group">
                    <label for="productDesc">Mô tả sản phẩm</label>
                    <textarea name="description" rows="6" class="form-control"><?= $product['description'] ?></textarea>
                </div>
                <div class="form-group mb-3">
                    <span class="form-label">Mã danh mục</span>
                    <select name="categorie_id" id="">
                        <?php foreach ($categories as $cate): ?>
                            <option value="<?= $cate['id'] ?>"
                                <?= ($cate['id'] == $product['category_id']) ? 'selected' : '' ?>>
                                <?= $cate['cate_name'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <!--Dữ liệu id-->
                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                <div class="form-group mb-3">
                    <label class="form-label" for="">Trạng thái</label> <br>
                    <input type="radio" name="status" value="1" <?= $product['status'] == 1 ? 'checked' : '' ?> id=""> Đang kinh doanh
                    <input type="radio" name="status" value="0" <?= $product['status'] == 0 ? 'checked' : '' ?> id=""> Ngừng kinh doanh
                </div>

                <button type="submit" class="btn btn-info text-light" name="submitFormUpdateProduct">Cập nhật</button>

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