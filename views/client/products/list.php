<?php include_once ROOT_DIR . "views/client/header.php" ?>

<div class="container">
    <div class="row">
        <div class="col mt-3 m-2">
            <nav aria-label="breadcrumb" class="bg-light p-3 rounded">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="<?= ROOT_URL ?>" class="text-decoration-none text-primary">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $title?></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
    <div class="col-12 col-sm-3">
    <div class="card bg-light mb-3">
        
        <!-- Danh mục -->
        <div class="card-header bg-secondary text-white text-uppercase"><i class="fa fa-list"></i> Danh mục</div>
        <ul class="list-group category_block">
            <?php foreach ($categories as $cate) : ?>
                <li class="list-group-item">
                    <a href="<?= ROOT_URL . '?ctl=category&id=' . $cate['id'] ?>"><?= $cate["cate_name"] ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Bộ lọc -->
    <div class="card bg-light mb-3">
        <div class="card-header text-white text-uppercase bg-primary"><i class="fa fa-filter"></i> Bộ lọc</div>
        <form method="GET" action="<?= ROOT_URL ?>">
            <input type="hidden" name="ctl" value="filter">
            <!-- Lọc theo giá -->
            <div class="p-3">
                <label for="price_range">Khoảng giá:</label>
                <div class="input-group">
                    <input type="number" name="min_price" class="form-control" placeholder="Từ" min="0">
                    <input type="number" name="max_price" class="form-control" placeholder="Đến" min="0">
                </div>
            </div>
            <!-- Lọc theo đánh giá -->
            <div class="p-3">
                <label>Đánh giá:</label>
                <?php for ($i = 5; $i >= 1; $i--) : ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rating" value="<?= $i ?>" id="rating<?= $i ?>">
                        <label class="form-check-label" for="rating<?= $i ?>">
                            <?= str_repeat('★', $i) ?>
                        </label>
                    </div>
                <?php endfor; ?>
            </div>
            <!-- Nút áp dụng -->
            <div class="p-3 text-center">
                <button type="submit" class="btn btn-primary">Áp dụng bộ lọc</button>
            </div>
        </form>
    </div>
</div>

        <div class="col">
            <div class="card-body">
            <div class="row">
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm">
                                <img
                                    src="<?= ROOT_URL . $product['image']; ?>"
                                    class="card-img-top"
                                    alt="<?= htmlspecialchars($product['name']); ?>"
                                    style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <a href="<?= ROOT_URL . "?ctl=detail&id=" . $product['id']; ?>"><h5 class="card-title text-truncate"><?= $product['name']; ?></h5></a>
                                    <p class="card-text text-muted">
                                        Giá: <strong><?= number_format($product['price'], 0, ',', '.'); ?> VND</strong>
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="<?= ROOT_URL . "?ctl=detail&id=" . $product['id']; ?>" class="btn btn-primary btn-sm">
                                            Xem chi tiết
                                        </a>
                                        <a href="<?= ROOT_URL . '?ctl=add-cart&id=' . $product['id'] ?>" class="btn btn-primary btn-sm">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                </div>
                <div class="col-12 mt-6">
                <?php if (isset($totalPages) && $totalPages > 1) : ?>
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?ctl=product&page=<?= $page - 1 ?>"><</a>
                                </li>
                                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                        <a class="page-link" href="?ctl=product&page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>
                                <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?ctl=product&page=<?= $page + 1 ?>">></a>
                                </li>
                            </ul>
                        </nav>
                    <?php else : ?>
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?ctl=product&page=<?= $page - 1 ?>"><</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="?ctl=product&page=1">1</a>
                                </li>
                                <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?ctl=product&page=<?= $page + 1 ?>">></a>
                                </li>
                            </ul>
                        </nav>
                    <?php endif; ?>


                </div>
            </div>
        </div>

    </div>
</div>

<?php include_once ROOT_DIR . "views/client/footer.php" ?>