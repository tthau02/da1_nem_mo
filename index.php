<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('Asia/Ho_Chi_Minh');

require_once __DIR__ . "/libraries/PHPMailer/PHPMailer.php";
require_once __DIR__ . "/libraries/PHPMailer/SMTP.php";
require_once __DIR__ . "/libraries/PHPMailer/Exception.php";

require_once __DIR__ . "/env.php";
require_once __DIR__ . "/common/function.php";
require_once __DIR__ . "/models/BaseModel.php";
require_once __DIR__ . "/models/Category.php";
require_once __DIR__ . "/models/Product.php";
require_once __DIR__ . "/models/User.php";
require_once __DIR__ . "/models/Comment.php";
require_once __DIR__ . "/models/Order.php";
require_once __DIR__ . "/models/VNPay.php";

require_once __DIR__ . "/controllers/HomeController.php";
require_once __DIR__ . "/controllers/admin/AdminProductController.php";
require_once __DIR__ . "/controllers/SearchController.php";
require_once __DIR__ . "/controllers/ProductController.php";
require_once __DIR__ . "/controllers/CartController.php";
require_once __DIR__ . "/controllers/AuthController.php";
require_once __DIR__ . "/controllers/CommentController.php";
require_once __DIR__ . "/controllers/UserController.php";
require_once __DIR__ . "/controllers/PaymentController.php";
require_once __DIR__ . "/controllers/OrderController.php";



$ctl = $_GET['ctl'] ?? '';



match ($ctl) {
    '', 'home' => (new HomeController)->index(),
    'search' => (new SearchController)->search(),
    'search' => (new SearchController)->search(),
    'product' => (new ProductController)->all(),
    'category' => (new ProductController)->getProductByCategory(),
    'detail' => (new ProductController)->detail(),
    'filter' => (new ProductController)->filter(),

    'login' => (new AuthController)->login(),
    'signup' => (new AuthController)->register(),
    'logout' => (new AuthController)->logout(),

    'add-cart' => (new CartController)->addCart(),

    'add-comment' => (new CommentController)->addComment(),

    'showCart' => (new CartController)->showCart(),

    'deCreaseQuantity' => (new CartController)->deCreaseQuantity(),

    'inCreaseQuantity' => (new CartController)->inCreaseQuantity(),


    'removeCart' => (new CartController)->removeCart(),

    'payCart' => (new PaymentController)->showPaymentForm(),

    'checkout' => (new PaymentController)->checkout(),

    'success' => (new PaymentController)->success(),
    'vnpay-callback' => (new PaymentController)->callback(),


    'edit-profile' => (new UserController)->edit(),
    'updateprofile' => (new UserController)->update(),
    'list-order' => (new OrderController)->showOrderUser(),
    'detail-order' => (new OrderController)->OrderUserDetail(),
    'cancel-order' => (new OrderController)->cancelOrder(),

    'introduce' => (new HomeController)->intro(),
    'contact' => (new HomeController)->contact(),
    'policy' => (new HomeController)->policy(),

    default => view("errors.404"),
};
