<?php include_once ROOT_DIR . "views/client/header.php"; ?>

<style>
        .hero-section {
            background: url('https://270349907.e.cdneverest.net/fast/filters:format(webp)/admin-api.vuanem.com/api/file/download/71fd813e-eccd-4c04-b3a2-4df8d771c44b') no-repeat center center;
            background-size: cover;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
        }
        .hero-section h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .contact-form {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .contact-info {
            padding: 20px;
        }
        .contact-info i {
            font-size: 1.5rem;
            color: #007bff;
            margin-right: 10px;
        }
        .map-container iframe {
            border-radius: 8px;
        }
    </style>

<section class="hero-section">
        <div>
            <h1>Liên Hệ Với Chúng Tôi</h1>
            <p>Nệm Mơ luôn sẵn sàng lắng nghe bạn!</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Contact Form -->
                <div class="col-md-6">
                    <div class="contact-form">
                        <h2 class="mb-4">Gửi Tin Nhắn</h2>
                        <form action="send-message.php" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Họ và Tên</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Lời Nhắn</label>
                                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Nhập lời nhắn" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </form>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-md-6">
                    <div class="contact-info">
                        <h2 class="mb-4">Thông Tin Liên Hệ</h2>
                        <p><i class="bi bi-geo-alt"></i> Địa chỉ: 13 Trịnh Văn Bô - Nam Từ Liêm</p>
                        <p><i class="bi bi-telephone"></i> Điện thoại: +84 123 456 789</p>
                        <p><i class="bi bi-envelope"></i> Email: support@nemmo.com</p>
                        <p><i class="bi bi-clock"></i> Giờ làm việc: 8:00 - 20:00 (Tất cả các ngày trong tuần)</p>
                    </div>
                    <!-- Embedded Map -->
                    <div class="map-container mt-4">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.639674057902!2d106.62966331480056!3d10.762622992326422!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752eddb3f48841%3A0x2a9c29e2f24aeef1!2zMTIzIMSQxrDhu51uZyBO4buHLCBQaMaw4budbmcgQW4gTOG6oWMsIFF14bqjbmcgQuG7mW5oIFThuqFuLCBUUC5IQ00!5e0!3m2!1svi!2s!4v1696826409676!5m2!1svi!2s"
                            width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include_once ROOT_DIR . "views/client/footer.php"; ?>