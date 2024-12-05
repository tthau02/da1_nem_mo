<?php include_once ROOT_DIR . "views/client/header.php" ?>

<div class="container mt-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="<?= ROOT_URL . $user['image'] ?>" alt="User Avatar" class="rounded-circle img-fluid mb-3" style="width: 160px; height: 160px;">
                        <h6 class="card-title"><?= $user["fullname"] ?></h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="?ctl=edit-profile" class="text-decoration-none"><i class="fa fa-user"></i> Thông tin cá nhân</a>
                        </li>
                        <li class="list-group-item">
                            <a href="?ctl=list-order" class="text-decoration-none"><i class="fa fa-shopping-cart"></i> Lịch sửa mua hàng</a>
                        </li>
                        <li class="list-group-item">
                            <a href="<?= ROOT_URL . '?ctl=logout' ?>" class="text-decoration-none"><i class="fa fa-sign-out-alt"></i> Đăng Xuất</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5>Cập nhật thông tin</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= ROOT_URL . '?ctl=updateprofile' ?>" method="post" enctype="multipart/form-data" >
                            <div class="row">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName" class="form-label">Họ và tên</label>
                                    <input type="text" class="form-control" name="fullname" placeholder="Nguyễn Văn A" value="<?= $user['fullname'] ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName" class="form-label">Nick name</label>
                                    <input type="text" class="form-control" name="username" placeholder="VanA" value="<?= $user['username'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="johndoe@example.com" value="<?= $user["email"] ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="tel" class="form-control" name="phone" placeholder="(123) 456-7890" value="<?= $user["phone"] ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                  <label for="avatar" class="form-label">Ảnh đại diện</label>
                                  <input type="file" class="form-control"  name="image" accept="image/*">
                              </div>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" name="address" placeholder="123 Main St, City, Country" value="<?= $user["address"] ?>">
                            </div>
                            <button type="submit" class="btn btn-primary mb-3" name="updateProfileUser">Cập Nhật</button>
                        </form>
                            <?php
                                if (isset($_SESSION['success_message'])) {
                                    echo '<div class="alert alert-success" role="alert">' . $_SESSION['success_message'] . '</div>';
                                    unset($_SESSION['success_message']);
                                    }
                                if (isset($_SESSION['error_message'])) {
                                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
                                    unset($_SESSION['error_message']);
                                    }
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include_once ROOT_DIR . "views/client/footer.php" ?>