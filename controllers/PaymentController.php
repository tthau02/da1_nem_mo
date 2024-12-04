<?php
class PaymentController
{
    public function showPaymentForm()
    {

        $categories = (new Category)->all();
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
        return view('client.payment', compact('user', 'carts', 'totalPrice', 'categories'));
    }

    public function checkout()
    {
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




        (new User)->update($user['id'], $user);
        $order_id = (new Order)->create($order);


        foreach ($carts as $id => $cart) {
            $order_detail = [
                'order_id' => $order_id,
                'product_id' => $id,
                'price' => $cart['price'],
                'quantity' => $cart['quantity'],

            ];

            (new Order)->createOrderDetail($order_detail);
            // Cập nhật số lượng sản phẩm trong kho
            $product = (new Product())->find($id); // Lấy thông tin sản phẩm
            $newQuantity = $product['quantity'] - $cart['quantity']; 
            if ($newQuantity < 0) {
                // Xử lý lỗi khi số lượng không đủ
                return view('client.payment_fail', ['message' => 'Sản phẩm trong kho không đủ số lượng!']);
            }
            (new Product())->updateQuantity($id, ['quantity' => $newQuantity]); // Cập nhật số lượng
        }
        if ($_POST['payment'] === 'vnpay') {
            $vnpay = new VNPay();
            $paymentUrl = $vnpay->createPaymentUrl($order_id, $totalPrice);
            header("Location: $paymentUrl"); // Redirect sang VNPay
            exit;
        }
        $this->clearCart();

        return header("Location:" . ROOT_URL . "?ctl=success");
    }
    public function callback()
    {
        $vnpay = new VNPay();
        $transactionData = $vnpay->handleCallback($_GET);

        if ($transactionData['status'] === 'success') {
            // Cập nhật trạng thái đơn hàng
            (new Order())->updateStatus($transactionData['data']['vnp_TxnRef'], 3);

            return view('client.payment_success', ['data' => $transactionData['data']]);
        } elseif ($transactionData['status'] === 'fail') {
            // Cập nhật trạng thái đơn hàng
            (new Order())->updateStatus($transactionData['data']['vnp_TxnRef'], 4);

            return view('client.payment_fail', ['data' => $transactionData['data']]);
        } else {
            return view('client.payment_invalid', ['message' => $transactionData['message']]);
        }
    }

    public function success()
    {
        $title = 'Thanh Toán';
        // $categories = (new Category)->all();
        return view('client.success', compact('title'));
        // , 'categories'
    }

    // xoá giỏ hàng 
    public function clearCart()
    {
        unset($_SESSION['cart']);
    }
}
