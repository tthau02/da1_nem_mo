<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($title) ? $title : 'Nệm Mơ' ?></title>
  <link rel="icon" href="./assets/images/logo_nem_mo.png" sizes="16x16">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/theme.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
</head>
<style>
  body {
  padding-top: 78px; 
  }
</style>
<body>
  <header class="header bg-light py-2 fixed-top">
    <div class="container">
      <div class="header-navbar d-flex align-items-center justify-content-between">

        <!-- Phần logo -->
        <div class="d-flex">
          <a class="navbar-brand fs-4" href="<?= ROOT_URL ?>">
            <img class="logo" src="./assets/images/logo_nem_mo.png" alt="logo">
            <span class="text-warning fs-3">Nệm</span>Mơ
          </a>
        </div>

        <!-- Phần menu điều hướng -->
        <div class="d-flex">
          <nav class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav mx-auto">
                <li class="nav-item dropdown">
                  <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    id="navbarDropdown"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <span>Danh Mục Sản Phẩm</span>
                    <i class="fas fa-chevron-down ms-2"></i>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                    foreach ($categories as $cate) {
                    ?>
                      <li><a class="dropdown-item" href="<?= ROOT_URL . '?ctl=category&id=' . $cate['id'] ?>"><?= $cate["cate_name"] ?></a></li>
                    <?php
                    }
                    ?>
                  </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Giới thiệu</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Liên hệ</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Chính sách</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>

        <!-- Phần tìm kiếm và thông tin người dùng -->
        <div class="d-flex align-items-center">
          <form class="d-flex me-3 position-relative w-100" role="search">
            <input id="keyword" class="form-control pe-5 w-100" type="search" placeholder="Search">
            <span class="position-absolute top-50 end-0 translate-middle-y pe-3 search-icon">
              <button id="search" type="button" class="btn p-0 border-0 bg-transparent"><i class="fa-solid fa-search text-muted"></i></button>
            </span>
          </form>


          <div class="d-flex justify-content-center align-items-center widgets-wrap float-md-right ml-4">
            <div class="widget-header d-flex justify-content-center align-items-center">

              <a href="<?= ROOT_URL . "?ctl=showCart" ?>" class="icon icon-sm rounded-circle border">
                <i class="fa fa-shopping-cart"></i>

              </a>
              <span class="badge badge-pill badge-danger notify"><?=isset($totalQuantity) ? $totalQuantity : 0 ?></span>
            </div>
            <?php
            if (isset($_SESSION['user_id'])) {
              // Lấy thông tin người dùng từ cơ sở dữ liệu
              $user = (new User)->find($_SESSION['user_id']);
              // Kiểm tra xem người dùng có ảnh đại diện không, nếu không thì sử dụng ảnh mặc định
              // $userImage = !empty($user['image']) ? ROOT_URL . $user['image'] : ROOT_URL . '/assets/images/default-avatar.png';
              $userImage = ROOT_URL . $user['image'];
            ?>
              <div class="widget-header dropdown">
                <a href="#" class="icon d-flex align-items-center justify-items-center icon-sm rounded-circle border" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="<?= htmlspecialchars($userImage) ?>" alt="Avatar" class="rounded-circle" style="width: 35px; height: 35px;">
                </a>               
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <a class="dropdown-item" href="?ctl=edit-profile">Thông tin cá nhân</a>
                  <a class="dropdown-item" href="#">Lịch sử mua hàng</a>
                  <a class="dropdown-item" href="<?= ROOT_URL . '?ctl=logout' ?>">Đăng xuất</a>
                </div>
              </div>
            <?php
            } else {
            ?>
              <!-- Phần Icon fa-user -->
              <div class="widget-header">
                <a href="#" class=" d-flex justify-content-center align-items-center icon icon-sm rounded-circle border" data-bs-toggle="modal" data-bs-target="#authModal">
                  <i class="fa fa-user"></i>
                </a>
              </div>

              <!-- Modal -->
              
            <?php } ?>
  </header>