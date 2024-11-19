<?php include_once ROOT_DIR . "views/client/header.php" ?>

<div class="container my-5">
    <div class="row">
        <div class="col mt-3 m-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="">Sản phẩm</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <!-- Hình ảnh sản phẩm -->
        <div class="col-md-6">
            <img src="https://baothainguyen.vn/file/e7837c027f6ecd14017ffa4e5f2a0e34/e7837c0280098a3201801c03d1e521f3/112022/word_image_1667981994169.png" alt="Sản phẩm" class="product-image img-fluid">
        </div>
        
        <!-- Chi tiết sản phẩm -->
        <div class="col-md-6 product-details">
            <h3 class="mb-3">Tên Sản Phẩm Cao Cấp</h3>
            <p class="text-muted">Mã sản phẩm: SP001</p>
            
            <!-- Đánh giá sao -->
            <div class="rating mb-3">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-alt"></i>
                <i class="fa fa-star-o"></i>
                <span class="text-muted">(4.5 trên 5 sao)</span>
            </div>

            <h4 class="product-price mb-3">200,000 VND</h4>
            
            <!-- Mô tả sản phẩm -->
            <p class="text-secondary mb-4">Sản phẩm cao cấp được thiết kế đặc biệt với chất liệu vải bền bỉ, mang đến sự thoải mái và phong cách. Đảm bảo hài lòng cho khách hàng với sự tinh tế và chất lượng tuyệt hảo.</p>
            
            <!-- Tùy chọn số lượng và nút giỏ hàng -->
            <div class="mb-3">
                <label for="quantity" class="form-label">Số lượng</label>
                <div class="input-group">
                    <button class="btn btn-outline-secondary" type="button" id="decreaseQuantity">-</button>
                    <input type="number" id="quantity" class="form-control text-center" value="1" min="1" style="max-width: 70px;">
                    <button class="btn btn-outline-secondary" type="button" id="increaseQuantity">+</button>
                </div>
                <button class="btn btn-danger btn-add-cart ms-3">Thêm vào giỏ hàng</button>
            </div>
            
            <!-- Thông tin bổ sung -->
            <ul class="list-unstyled text-muted">
                <li><strong>Thương hiệu:</strong> Thương hiệu A</li>
                <li><strong>Chất liệu:</strong> Vải cao cấp</li>
                <li><strong>Xuất xứ:</strong> Việt Nam</li>
            </ul>
        </div>
    </div>

    <!-- Mô tả chi tiết sản phẩm -->
    <div class="my-5">
        <h4>Mô Tả Chi Tiết</h4>
        <p>Được sản xuất từ chất liệu vải tốt nhất, sản phẩm mang đến sự thoải mái và phù hợp với phong cách hiện đại. Tất cả các sản phẩm đều trải qua quy trình kiểm tra nghiêm ngặt để đảm bảo chất lượng cao.</p>
        <p>Sản phẩm này sẽ là lựa chọn lý tưởng cho mọi dịp, từ đi làm, đi chơi đến các sự kiện quan trọng.</p>
    </div>

    <div class="my-5">
        <h4>Đánh Giá Sản Phẩm</h4>
        
        <!-- Phần hiển thị các bình luận -->
        <div class="review-card mb-3 d-flex align-items-start">
            <img src="https://via.placeholder.com/50" alt="Avatar" class="rounded-circle me-3">
            <div>
                <p><strong>Nguyễn Văn A</strong> <span class="text-muted">- 01/01/2024</span></p>
                <p>Sản phẩm rất tốt, chất liệu mềm mại và phù hợp với giá tiền. Chắc chắn sẽ quay lại mua hàng.</p>
            </div>
        </div>
        <div class="review-card mb-3 d-flex align-items-start">
            <img src="https://via.placeholder.com/50" alt="Avatar" class="rounded-circle me-3">
            <div>
                <p><strong>Trần Thị B</strong> <span class="text-muted">- 02/01/2024</span></p>
                <p>Sản phẩm đẹp, màu sắc hài hòa và thoải mái khi mặc. Giao hàng nhanh chóng.</p>
            </div>
        </div>
        <div class="review-card mb-3 d-flex align-items-start">
            <img src="https://via.placeholder.com/50" alt="Avatar" class="rounded-circle me-3">
            <div>
                <p><strong>Lê Minh C</strong> <span class="text-muted">- 03/01/2024</span></p>
                <p>Đây là lần thứ hai tôi mua sản phẩm này, lần nào cũng hài lòng.</p>
            </div>
        </div>
    
        <!-- Phần nhập bình luận mới -->
        <div class="mt-4">
            <h5>Viết Đánh Giá Của Bạn</h5>
            <form id="commentForm"> 
                <div class="mb-3">
                    <label for="comment" class="form-label">Bình luận</label>
                    <textarea id="comment" class="form-control" rows="3" placeholder="Viết đánh giá của bạn ở đây" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Gửi Đánh Giá</button>
            </form>
        </div>
    </div>

    <!-- Sản phẩm liên quan -->
    <div class="related-products my-5">
        <h4>Sản Phẩm Liên Quan</h4>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <img src="https://demhong.vn/wp-content/uploads/2019/04/chan-ga-goi-don-sac-ghi.jpg" class="card-img-top" alt="Sản phẩm 1">
                    <div class="card-body text-center">
                        <h5 class="card-title">Sản Phẩm 1</h5>
                        <p class="text-danger">100,000 VND</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="link_image_san_pham2.jpg" class="card-img-top" alt="Sản phẩm 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">Sản Phẩm 2</h5>
                        <p class="text-danger">150,000 VND</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="link_image_san_pham3.jpg" class="card-img-top" alt="Sản phẩm 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Sản Phẩm 3</h5>
                        <p class="text-danger">120,000 VND</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="link_image_san_pham4.jpg" class="card-img-top" alt="Sản phẩm 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Sản Phẩm 4</h5>
                        <p class="text-danger">180,000 VND</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  

<?php include_once ROOT_DIR . "views/client/footer.php" ?>