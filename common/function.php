<?php

//Hàm render view
function view($path_view, $data = [])
{
    extract($data);

    $path_view = str_replace(".", "/", $path_view);

    include_once ROOT_DIR . "views/$path_view.php";
}

//hàm dd dùng để debug lỗi
function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

// chuyển đổi trạng thái đơn hàng
 function getOrderStatus($status){
    $status_detail = [
        1 => 'Chờ xử lý',
        2 => 'Đang xử lý',
        3 => 'Đã hoàn thành',
        4 => 'Đã huỷ'
    ];

    return $status_detail[$status];
 }
