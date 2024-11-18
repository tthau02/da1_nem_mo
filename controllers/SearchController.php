<?php 
    class SearchController {
        public function search(){
            $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
    
            // Kiểm tra nếu từ khóa rỗng
            if ($keyword === '') {
                // Hiển thị thông báo hoặc không trả về sản phẩm nào
                $products = [];
                $message = "Vui lòng nhập từ khóa để tìm kiếm.";
            } else {
                // Thực hiện tìm kiếm với từ khóa
                $products = (new Product)->search($keyword);
                $message = null;
            }
    
            return view("client.products.search", compact('keyword', 'products', 'message'));
        }
    }

?>