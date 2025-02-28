<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Admin' ?></title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/css/theme.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="<?php echo ADMIN_URL; ?>">Nệm Mơ</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#product-management" aria-expanded="false" aria-controls="product-management">
                        <i class="lni lni-package"></i>
                        <span>Quản Lý Sản Phẩm</span>
                    </a>
                    <ul id="product-management" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="?ctl=listdm" class="sidebar-link">Danh Mục Sản Phẩm</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="?ctl=listsp" class="sidebar-link">Danh Sách Sản Phẩm</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="?ctl=list-order" class="sidebar-link">
                        <i class="lni lni-cart"></i>
                        <span>Danh Sách Đơn Hàng</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="?ctl=listuser" class="sidebar-link">
                        <i class="lni lni-users"></i>
                        <span>Quản lý người dùng</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="?ctl=listcomment" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>Bình Luận & Đánh Giá</span>
                    </a>
                </li>

            </ul>
            <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>