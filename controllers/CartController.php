<?php 
    class CartController {
        public function addCart() {
            
    
            $carts = $_SESSION['cart'] ?? []; // Tạo giỏ hàng nếu chưa có
            $id = $_GET['id'] ?? null; // Lấy ID sản phẩm từ GET
    
            // Kiểm tra ID hợp lệ
            
    
            // Lấy sản phẩm theo ID
            $product = (new Product())->find($id);
            
    
            // Kiểm tra sản phẩm có trong giỏ hàng
            if (isset($carts[$id])) {
                $carts[$id]['quantity'] += 1;
            } else{
                $carts[$id] = [
                    'name' => $product['name'],
                    'image' => $product['image'],
                    'price' => $product['price'],
                    'quantity' => 1
                ];
            }
    
            // Lưu giỏ hàng vào session
            $_SESSION['cart'] = $carts;
            // Lấy URI hoặc gán giá trị mặc định
            $uri = $_SESSION['URI'] ?? $_SERVER['HTTP_REFERER'] ?? ROOT_URL;
            header("Location: " . $uri);
            exit();
        }
    
        // Tính tổng số lượng sản phẩm trong giỏ hàng
        public function totalQuantityCart() {
            $carts = $_SESSION['cart'] ?? [];
            $totalQuantity = 0;
    
            foreach ($carts as $cart) {
                $totalQuantity += $cart['quantity'];
            }
    
            return $totalQuantity;
        }
    }

?>