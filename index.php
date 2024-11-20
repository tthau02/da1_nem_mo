<?php
require_once __DIR__ . "/env.php";
require_once __DIR__ . "/common/function.php";
require_once __DIR__ . "/models/BaseModel.php";
require_once __DIR__ . "/models/Category.php";
require_once __DIR__ . "/models/Product.php";
require_once __DIR__ . "/models/User.php";

require_once __DIR__ . "/controllers/HomeController.php";
require_once __DIR__ . "/controllers/admin/AdminProductController.php";
require_once __DIR__ . "/controllers/SearchController.php";
require_once __DIR__ . "/controllers/ProductController.php";


$ctl = $_GET['ctl'] ?? '';



match ($ctl) {
    '', 'home' => (new HomeController)->index(),
    'search' => (new SearchController)->search(),
    'product' => (new ProductController)->all(),
    'category' => (new ProductController)->getProductByCategory(),
    'detail' => (new ProductController)->detail(),
    default => view("errors.404"),
};
