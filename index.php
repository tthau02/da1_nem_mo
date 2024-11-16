<?php
require_once __DIR__ . "/env.php";
require_once __DIR__ . "/common/function.php";
require_once __DIR__ . "/models/BaseModel.php";
require_once __DIR__ . "/models/Category.php";
require_once __DIR__ . "/models/Product.php";

require_once __DIR__ . "/controllers/HomeController.php";

$ctl = $_GET['ctl'] ?? '';

//Danh mục
// $data = [
//     'cate_name' => 'Con Sư Tử',
//     'type' => 1, //type=1 là thú cưng
// ];
// $cate = new Category;
// // $cate->create($data); //Thêm
// // $cate->update(4, $data);
// echo "<pre>";
// var_dump($cate->all()); //lấy toàn bộ

// var_dump($cate->find(3)); //chỉ lấy 1 bản ghi

//Sản phẩm
$data = [
    'name' => 'Súp thưởng cho mèo, cat food đầy đủ dinh dưỡng',
    'image' => '',
    'price' => 100000,
    'quantity' => 100,
    'description' => 'Súp thưởng cho mèo, cat food đầy đủ dinh dưỡng giá rẻ thanh 15g Món ăn cho mèo Món ăn cho thú cưng Món ăn cho mè',
    'status' => 1,
    'category_id' => 1
];
$product = new Product;
// $product->create($data); //thêm sản phẩm
$product->update(1, $data);

echo "<pre>";
var_dump($product->all()); //lấy toàn bộ sản phẩm
var_dump($product->find(1)); //lấy 1 sản phẩm

match ($ctl) {
    '', 'home' => (new HomeController)->index(),
    default => view("errors.404"),
};
