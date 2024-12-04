<?php include "./views/client/header.php" ?>


<div class="container my-4">
    <h3 class="mb-4 text-center">Kết quả tìm kiếm cho từ khóa: <strong><?= htmlspecialchars($keyword); ?></strong></h3>

    <?php if (!empty($products)): ?>
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm">
                        <a style="height: 200px" href="<?= ROOT_URL . "?ctl=detail&id=" . $product['id']; ?>">
                            <img
                                src="<?= ROOT_URL . $product['image']; ?>"
                                class="card-img-top"
                                alt="<?= htmlspecialchars($product['name']); ?>"
                                style=" height: 200px;  object-fit: cover;">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title text-truncate"><?= $product['name']; ?></h5>
                            <p class="card-text text-muted">
                                Giá: <strong><?= number_format($product['price'], 0, ',', '.'); ?> VND</strong>
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="<?= ROOT_URL . "?ctl=product&id=" . $product['id']; ?>" class="btn btn-outline-primary btn-sm">
                                    Xem chi tiết
                                </a>
                                <a href="<?= isset($_SESSION['user_id']) ? ROOT_URL . '?ctl=add-cart&id=' . $product['id'] : '#' ?>"
                                    class="btn btn-outline-danger btn-sm"
                                    <?= !isset($_SESSION['user_id']) ? 'data-bs-toggle="modal" data-bs-target="#authModal"' : '' ?>>Thêm vào giỏ</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">
            Không tìm thấy sản phẩm nào phù hợp với từ khóa "<strong><?= $keyword; ?></strong>".
        </div>
    <?php endif; ?>
</div>

<?php include "./views/client/footer.php" ?>