<?php include_once ROOT_DIR . "views/client/header.php" ?>

<div class="container">
    <div class="row">
        <div class="col mt-3 m-2">
            <nav aria-label="breadcrumb" class="bg-light p-3 rounded">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="<?= ROOT_URL ?>" class="text-decoration-none text-primary">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-3">
            <div class="card bg-light mb-3">
                <form class="pb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="button"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <div class="card-header bg-secondary text-white text-uppercase"><i class="fa fa-list"></i> Danh mục
                </div>
                <ul class="list-group category_block">
                    <?php
                    foreach ($categories as $cate) {
                    ?>
                        <li class="list-group-item"><a href="<?= ROOT_URL . '?ctl=category&id=' . $cate['id'] ?>"><?= $cate["cate_name"] ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="card bg-light mb-3">
                <div class="card-header bg-success text-white text-uppercase">Sản phẩm hot nhất</div>
                <div class="card-body">
                    <img class="img-fluid" src="https://dummyimage.com/600x400/55595c/fff" />
                    <h5 class="card-title">Product title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                        the card's content.</p>
                    <p class="red text-center font-weight-bold">99.00 $</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card-body">
                    <div class="row">
                        <?php
                        foreach ($products as $product) {
                            ?>
                            <div class="col-md-4 mt-3">
                                <div class="card-product shadow-sm">
                                    <img class="card-img-top" src="<?= ROOT_URL . $product['image'] ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title text-center">
                                            <a href="?ctl=detail" title="View Product" class=""><?= $product['name'] ?></a>
                                        </h4>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="col">
                                                <p class="fw-bold text-danger fs-6 mt-3"><?= number_format($product['price'], 0, ',', '.') ?> VND</p>
                                            </div>
                                            <div class="">
                                                <a href="cart.html" class="btn btn-outline-success">+ Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    <?php endforeach; ?>
                        
                </div>
            </div>
            <div class="col-12">
                <nav aria-label="...">
                    <ul class="pagination justify-content-center mt-5">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active">
                            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

</div>
</div>

<?php include_once ROOT_DIR . "views/client/footer.php" ?>