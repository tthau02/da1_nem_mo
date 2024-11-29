<?php 
    class PaymentController {
        public function showPaymentForm(){
            
            $user = $_SESSION['user'] ?? [
                'fullname' => '',
                'address' => '',
                'phone' => '',
                'email' => ''
            ]; // Giá trị mặc định nếu user chưa đăng nhập
            
            $carts = $_SESSION['cart'] ?? []; 

            $totalPrice = 0;
            foreach ($carts as $cart) {
                $totalPrice += $cart['price'] * $cart['quantity'];
            }




            return view('client.payment',compact('user', 'carts', 'totalPrice'));
        }

        public function checkout(){
            // Lấy thông tin người dùng 
            $user = [
                'id' => $_POST['id'],
                'fullname' => $_POST['fullname'],
                'address' => $_POST['address'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'updated_at' => date('Y-m-d H:i:s'),
                'username' => $_POST['username'] ?? '', // Nếu không có, gán giá trị mặc định
                'image' => $_POST['image'] ?? '', // Nếu không có, gán giá trị mặc định
            ];

            
            $carts = $_SESSION['cart'] ?? [];
            
            $totalPrice = 0;
            foreach ($carts as $cart) {
                $totalPrice += $cart['price'] * $cart['quantity'];
            }
            // lấy thông tin thanh toán
            $order = [
                'user_id' => $_POST['id'],
                'status' => 1,
                'payment' => $_POST['payment'],
                'total_price' => $totalPrice,
                
            ];

            
            

            (new User) -> update($user['id'],$user);
            $order_id = (new Order) -> create($order);

            
            foreach($carts as $id => $cart){
                $order_detail = [
                    'order_id' => $order_id,
                    'product_id' => $id,
                    'price' => $cart['price'],
                    'quantity' => $cart['quantity'],
                    
                ];

                (new Order) -> createOrderDetail($order_detail);
            }
            $this->clearCart();

            return header("Location:" . ROOT_URL. "?ctl=success");
        }

        public function success(){
            return view('client.success');
        }
        
        // xoá giỏ hàng 
        public function clearCart(){
            unset($_SESSION['cart']);
            
        }
    }

?>