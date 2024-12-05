<footer class="text-light mt-10">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-lg-4 col-xl-3 footer-contact">
                <h5>Về chúng tôi</h5>
                <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                <p class="mb-0">
                    Nệm Mơ - Trang thương mại điện tử lớn nhất Việt Nam
                </p>
            </div>

            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto">
                <h5>Thông tin</h5>
                <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                <ul class="list-unstyled">
                    <li><a href=""><i class="fas fa-map-marker-alt"></i> Trịnh Văn Bô - Nam Từ Liêm</a></li>
                    <li><a href=""><i class="fas fa-phone-volume"></i> 0987777911</a></li>
                    <li><a href=""><i class="fas fa-envelope"></i>nemmoshop@gmail.com</a></li>
                </ul>
            </div>

            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto">
                <h5>Chính sách</h5>
                <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                <ul class="list-unstyled">
                    <li><a href="">Chính sách bảo hành</a></li>
                    <li><a href="">Chính sách đổi hàng</a></li>
                    <li><a href="">Chính sách bảo mật</a></li>
                    <li><a href="">Chính sách vận chuyển</a></li>
                </ul>
            </div>

            <div class="col-md-3 col-lg-3 col-xl-3">
                <h5>Liên hệ</h5>
                <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                <ul class="list-unstyled">
                    <li><i class="fa fa-home mr-2"></i> Công ty</li>
                    <li><i class="fa fa-envelope mr-2"></i> nemmoshop@gmail.com</li>
                    <li><i class="fa fa-phone mr-2"></i> + 0987777911</li>
                    <li><i class="fa fa-print mr-2"></i> + 0987777911</li>
                </ul>
            </div>
            <div class="col-12 copyright mt-3">
                <p class="float-left btn">
                    <a href="#">Về đầu trang</a>
                </p>
            </div>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="./assets/js/mani.js"></script>
<script src="./assets/js/login.js"></script>
<script src="./assets/js/register.js"></script>
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
                              <input type="text" id="loginIdentifier" name="loginIdentifier" class="form-control" placeholder="Email..." />
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
                              <label class="form-label" for="registerName">Fullname</label>
                              <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Enter your name" />
                            </div>
                            <div class="form-outline mb-3">
                              <label class="form-label" for="registerName">Username</label>
                              <input type="text" id="registerName" name="registerName" class="form-control" placeholder="Enter your username" />
                            </div>
                            <div class="form-outline mb-3">
                              <label class="form-label" for="registerEmail">Email</label>
                              <input type="email" id="registerEmail" name="registerEmail" class="form-control" placeholder="Enter your email" />
                            </div>
                            <div class="form-outline mb-3">
                              <label class="form-label" for="registerPassword">Password</label>
                              <input type="password" id="registerPassword" name="registerPassword" class="form-control" placeholder="Create a password" />
                            </div>
                            <div class="form-outline mb-4">
                              <label class="form-label" for="registerConfirmPassword">Confirm Password</label>
                              <input type="password" id="registerConfirmPassword" name="registerConfirmPassword" class="form-control" placeholder="Confirm your password" />
                            </div>
                            <div id="registerError" class="alert alert-danger d-none"></div>
                            <div id="registerSuccess" class="alert alert-success d-none"></div>

                            <?php if (!empty($_SESSION['error_message'])): ?>
                              <div id="error-message" class="error-login alert alert-danger alert-dismissible fade show p-2 small ">
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

<script>
    // lấy button 
    search = document.getElementById('search');
    keyword = document.getElementById('keyword');
    // viết sự kiện cho nút search
    search.addEventListener('click', function() {
        searchProduct();
    })

    keyword.addEventListener('keydown', function(e) {
        if (e.key == 'Enter') {

            searchProduct()
            e.preventDefault();
        }
    })

    // Hàm search

    function searchProduct() {

        window.location = "<?= ROOT_URL ?>" + "?ctl=search&keyword=" + keyword.value;
    }
</script>
</body>

</html>