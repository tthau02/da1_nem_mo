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

<body>
  <header class="header bg-light py-2">
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


          <div class="widgets-wrap float-md-right ml-4">
            <div class="widget-header">

              <a href="#" class="icon icon-sm rounded-circle border">
                <i class="fa fa-shopping-cart"></i>

              </a>
              <span class="badge badge-pill badge-danger notify"><?=isset($totalQuantity) ? $totalQuantity : 0 ?></span>
            </div>
            <?php
            if (isset($_SESSION['user_id'])) {
            ?>
              <div class="widget-header dropdown">
                <a href="#" class="icon icon-sm rounded-circle border" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-user"></i></a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <a class="dropdown-item" href="#">Profile</a>
                  <a class="dropdown-item" href="#">Orders</a>
                  <a class="dropdown-item" href="<?= ROOT_URL . '?ctl=logout' ?>">Logout</a>
                </div>
              </div>
            <?php
            } else {
            ?>
              <!-- Phần Icon fa-user -->
              <div class="widget-header">
                <a href="#" class="icon icon-sm rounded-circle border" data-bs-toggle="modal" data-bs-target="#authModal">
                  <i class="fa fa-user"></i>
                </a>
              </div>

              <!-- Modal -->
              <div class="modal fade" id="authModal" tabindex="-4" aria-labelledby="authModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: #227952;">
                        <h5 class="modal-title" id="authModalLabel" style="margin-left: 100px; color: #fff;">Đăng Nhập Hoặc Tạo Tài Khoản</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                      <ul class="nav nav-pills nav-justified mb-4" id="authTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="tab-login" data-bs-toggle="pill" data-bs-target="#pills-login" type="button" role="tab" aria-controls="pills-login" aria-selected="true">
                            Đăng Nhập
                          </button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="tab-register" data-bs-toggle="pill" data-bs-target="#pills-register" type="button" role="tab" aria-controls="pills-register" aria-selected="false">
                            Đăng Ký
                          </button>
                        </li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                          <form action="<?= ROOT_URL . '?ctl=login' ?>" method="post">
                            <div class="form-outline mb-3">
                              <label class="form-label" for="loginIdentifier">Email</label>
                              <input type="text" id="loginIdentifier" name="loginIdentifier" class="form-control" placeholder="Email..."/>
                            </div>
                            <div class="form-outline mb-3">
                              <label class="form-label" for="loginPassword">Password</label>
                              <input type="password" id="loginPassword" name="password" class="form-control" placeholder="Password..." />
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                                <label class="form-check-label" for="loginCheck"> Remember me </label>
                              </div>
                              <a href="#" class="text-decoration-none">Quên mật khẩu?</a>
                            </div>
                              <?php if (!empty($_SESSION['error_message'])): ?>
                                  <div id="error-message" class="alert alert-danger alert-dismissible fade show p-2 small ">
                                      <?= $_SESSION['error_message']; ?>
                                  </div>
                                  <?php unset($_SESSION['error_message']); ?>
                              <?php endif; ?>
                            <div class="mt-8 mb-4 text-center">
                              <p></p>
                              <a href="#" class="mx-2"><i class="fab fa-facebook-f"></i> Facebook</a>
                              <a href="#" class="mx-2"><i class="fab fa-google"></i> Google</a>
                              <a href="#" class="mx-2"><i class="fab fa-twitter"></i> Twitter</a>
                            </div>
                            <button type="submit" class="btn btn-outline-success w-100 mt-4">Đăng Nhập</button>
                          </form>
                        </div>
                    <!-- register -->
                    <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                          <form id="registerForm" action="<?= ROOT_URL . '?ctl=signup' ?>" method="POST">
                              <div class="form-outline mb-3">
                                  <label class="form-label" for="registerName">Name</label>
                                  <input type="text" id="registerName" name="registerName" class="form-control" placeholder="Enter your name"/>
                              </div>
                              <div class="form-outline mb-3">
                                  <label class="form-label" for="registerEmail">Email</label>
                                  <input type="email" id="registerEmail" name="registerEmail" class="form-control" placeholder="Enter your email"/>
                              </div>
                              <div class="form-outline mb-3">
                                  <label class="form-label" for="registerPassword">Password</label>
                                  <input type="password" id="registerPassword" name="registerPassword" class="form-control" placeholder="Create a password"/>
                              </div>
                              <div class="form-outline mb-4">
                                  <label class="form-label" for="registerConfirmPassword">Confirm Password</label>
                                  <input type="password" id="registerConfirmPassword" name="registerConfirmPassword" class="form-control" placeholder="Confirm your password"/>
                              </div>
                              <div id="registerError" class="alert alert-danger d-none"></div>
                              <div id="registerSuccess" class="alert alert-success d-none"></div>

                              <?php if (!empty($_SESSION['error_message'])): ?>
                                  <div id="error-message" class="alert alert-danger alert-dismissible fade show p-2 small ">
                                      <?= $_SESSION['error_message']; ?>
                                  </div>
                                  <?php unset($_SESSION['error_message']); ?>
                              <?php endif; ?>

                              <button type="submit" class="btn btn-outline-success w-100">Đăng Ký</button>
                          </form>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
  </header>