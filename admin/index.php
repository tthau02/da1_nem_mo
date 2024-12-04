<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . "/../env.php";
require_once __DIR__ . "/../common/function.php";

//include models
require_once __DIR__ . "/../models/BaseModel.php";
require_once __DIR__ . "/../models/Category.php";
require_once __DIR__ . "/../models/Product.php";
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../models/Comment.php";
require_once __DIR__ . "/../models/Order.php";

//include controllers
require_once __DIR__ . "/../controllers/admin/AdminProductController.php";
require_once __DIR__ . "/../controllers/admin/AdminCategoryController.php";
require_once __DIR__ . "/../controllers/admin/AdminUserController.php";
require_once __DIR__ . "/../controllers/admin/AdminCommentController.php";
require_once __DIR__ . "/../controllers/OrderController.php";

$ctl = $_GET['ctl'] ?? "";

if ($_SESSION['user_role'] !== 'admin') {
    header("location: " . ROOT_URL);
    exit;
}

match ($ctl) {
    '' => view("admin.dashboard"),

    // sản phẩm
    'profile' => (new AdminUserController)->profile(),
    'listsp' => (new AdminProductController)->index(),
    'addsp' => (new AdminProductController)->create(),
    'storesp' => (new AdminProductController)->store(),
    'deletesp' => (new AdminProductController)->delete(),
    'editsp' => (new AdminProductController)->edit(),
    'updatesp' => (new AdminProductController)->update(),

    // danh mục
    'listdm' => (new AdminCategoryController)->index(),
    'adddm' => (new AdminCategoryController)->create(),
    'storedm' => (new AdminCategoryController)->store(),
    'deletedm' => (new AdminCategoryController)->delete(),
    'editdm' => (new AdminCategoryController)->edit(),
    'updatedm' => (new AdminCategoryController)->update(),

    // người dùng
    'listuser' => (new AdminUserController)->index(),
    'adduser' => (new AdminUserController)->create(),
    'storedm' => (new AdminUserController)->store(),
    'deleteuser' => (new AdminUserController)->delete(),
    'edituser' => (new AdminUserController)->edit(),
    'updateuser' => (new AdminUserController)->update(),

    // bình luận
    'listcomment' => (new AdminCommentController)->index(),
    'deletecomment' => (new AdminCommentController)->delete(),

    // order
    'list-order' => (new OrderController) ->index(),
    'detail-order' =>(new OrderController) ->showOrder(),
    // 'deleteOrder' => (new OrderController) ->removeOrder(),
    default => view('errors.404'),
};
