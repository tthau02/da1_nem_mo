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
        
    }

?>