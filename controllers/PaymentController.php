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
        }
        if ($_POST['payment'] === 'vnpay') {
            $vnpay = new VNPay();
            $paymentUrl = $vnpay->createPaymentUrl($order_id, $totalPrice);
            header("Location: $paymentUrl"); // Redirect sang VNPay
            exit;
        }
        $this->clearCart();

        $_SESSION['success_data'] = [
            'order_id' => $order_id,
            'total_price' => $totalPrice,
            'categories' => (new Category)->all(),
        ];
        return header("Location:" . ROOT_URL . "?ctl=success");
    }
    public function callback()
    {
        $categories = (new Category)->all();
        $order_id = $_GET['vnp_TxnRef'];
        $total_price = $_GET['vnp_Amount'] / 100;
        $vnpay = new VNPay();
        $transactionData = $vnpay->handleCallback($_GET);


        if ($transactionData['status'] === 'success') {
            $title = 'Thành công';

            $this->clearCart();
            return view('client.payment.success', compact('title', 'order_id', 'total_price', 'categories'));
        } elseif ($transactionData['status'] === 'fail') {
            $title = 'Giao dịch thất bại';

            return view('client.payment.fail', compact('title', 'categories'));
        } else {
            $title = 'Giao dịch không hợp lệ';
            return view('client.payment.invalid', compact('title', 'categories'));
        }
    }

    public function success()
    {
        $successData = $_SESSION['success_data'];
        $title = 'Thanh Toán';
        $categories = $successData['categories'];
        $order_id = $successData['order_id'];
        $total_price = $successData['total_price'];
        unset($_SESSION['success_data']);
        return view('client.success', compact('order_id', 'total_price', 'title', 'categories'));
    }

    // xoá giỏ hàng 
    public function clearCart()
    {
        unset($_SESSION['cart']);
    }
}
