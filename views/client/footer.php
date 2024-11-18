
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
                <p class="float-left btn btn-danger">
                    <a href="#">Về đầu trang</a>
                </p>
                <p class="text-right text-muted">@THSHOP. Design by nemmo</p>
            </div>
        </div>
    </div>
</footer>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/mani.js"></script>

    <script>
        // lấy button 
        search = document.getElementById('search');
        keyword = document.getElementById('keyword');
        // viết sự kiện cho nút search
        search.addEventListener('click', function(){
            searchProduct();
        })

        search.addEventListener('keydown', function(e){
            if(e.key === 'Enter'){
                searchProduct()
                e.preventDefault();
            }
        })

        // Hàm search

        function searchProduct(){
            
            window.location = "<?= ROOT_URL ?>" + "?ctl=search&keyword=" + keyword.value;
        }
    </script>
</body>
</html>
