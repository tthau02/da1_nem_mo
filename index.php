<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();


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

require_once __DIR__ . "/controllers/AuthController.php";



$ctl = $_GET['ctl'] ?? '';



match ($ctl) {
    '', 'home' => (new HomeController)->index(),
    'search' => (new SearchController)->search(),
    'product' => (new ProductController)->all(),
    'category' => (new ProductController)->getProductId(),
    'detail' => (new ProductController)->detail(),

    'login' => (new AuthController)->login(),
    'signup' => (new AuthController)->register(),
    'logout' => (new AuthController)->logout(),

    default => view("errors.404"),
};
