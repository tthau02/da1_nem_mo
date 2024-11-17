<?php
require_once __DIR__ . "/../env.php";
require_once __DIR__ . "/../common/function.php";

//include models
require_once __DIR__ . "/../models/BaseModel.php";
require_once __DIR__ . "/../models/Category.php";
require_once __DIR__ . "/../models/Product.php";

//include controllers
require_once __DIR__ . "/../controllers/admin/AdminProductController.php";
require_once __DIR__ . "/../controllers/admin/AdminCategoryController.php";
$ctl = $_GET['ctl'] ?? "";

match ($ctl) {
    '' => view("admin.dashboard"),
    'listsp' => (new AdminProductController)->index(),
    'addsp' => (new AdminProductController)->create(),
    'storesp' => (new AdminProductController)->store(),
    'editsp' => (new AdminProductController)->edit(),
    'updatesp' => (new AdminProductController)->update(),
    'listdm' => (new AdminCategoryController)->index(),
    // 'addsp' => (new AdminProductController)->create(),
    default => view('errors.404'),
};
