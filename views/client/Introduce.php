<?php include_once ROOT_DIR . "views/client/header.php"; ?>

<style>
        .hero-section {
            background: url('https://everonvietnam.com/wp-content/uploads/2024/09/top-banner-binh-minh-rang-ro-1400x496.png') no-repeat center center;
            background-size: cover;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
        }
        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .icon-box {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background-color: #f8f9fa;
            transition: transform 0.3s;
        }
        .icon-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .icon-box i {
            font-size: 3rem;
            color: #007bff;
            margin-bottom: 10px;
        }
        .cta-section {
            background-color: #ccc;
            color: #fff;
            padding: 40px 20px;
        }
        .cta-section h2 {
            font-size: 2.5rem;
        }
    </style>

<section class="hero-section">
        <div>
            <h1>Chào Mừng Đến Với Nệm Mơ</h1>
            <p>Chuyên cung cấp chăn ga gối đệm và các dụng cụ tốt nhất cho giấc ngủ của bạn.</p>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="https://cdnphoto.dantri.com.vn/1MV0LiWftq0UaNQYiw1gBhraDn8=/thumb_w/990/2021/08/14/nem-nbdocx-1628899537536.png" alt="Giới thiệu" class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                    <h2 class="mb-4">Về Chúng Tôi</h2>
                    <p>Nệm Mơ là đơn vị tiên phong trong việc cung cấp các sản phẩm chất lượng cao dành cho giấc ngủ. Với đội ngũ giàu kinh nghiệm và sự tận tâm, chúng tôi mang đến cho khách hàng sự thoải mái tối đa.</p>
                    <p>Chúng tôi cung cấp các sản phẩm như:</p>
                    <ul>
                        <li>Chăn ga gối đệm cao cấp</li>
                        <li>Các dụng cụ hỗ trợ giấc ngủ</li>
                        <li>Phụ kiện phòng ngủ hiện đại</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="mb-5">Tại Sao Chọn Chúng Tôi</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="icon-box">
                        <i class="bi bi-shield-check"></i>
                        <h5 class="mt-3">Chất Lượng Đảm Bảo</h5>
                        <p>Cam kết sản phẩm đạt chuẩn chất lượng cao nhất.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="icon-box">
                        <i class="bi bi-truck"></i>
                        <h5 class="mt-3">Giao Hàng Nhanh Chóng</h5>
                        <p>Dịch vụ giao hàng tận nơi tiện lợi và nhanh chóng.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="icon-box">
                        <i class="bi bi-heart"></i>
                        <h5 class="mt-3">Hỗ Trợ Tận Tâm</h5>
                        <p>Luôn đồng hành cùng khách hàng trong mọi tình huống.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section text-center">
        <div class="container">
            <h2 class="mb-4">Hãy Để Chúng Tôi Chăm Sóc Giấc Ngủ Của Bạn</h2>
            <p>Liên hệ ngay để nhận được tư vấn tốt nhất từ chúng tôi.</p>
            <a href="?ctl=contact" class="btn btn-light btn-lg">Liên Hệ Ngay</a>
        </div>
    </section>

<?php include_once ROOT_DIR . "views/client/footer.php"; ?>