<?php
class PaymentController
{
    public function showPaymentForm()
    {
        // Lấy danh sách danh mục
        $categories = (new Category())->all();

        // Lấy thông tin người dùng từ session hoặc giá trị mặc định
        $user = $_SESSION['user'] ?? [
            'fullname' => '',
            'address' => '',
            'phone' => '',
            'email' => ''
        ];

        // Lấy giỏ hàng từ session
        $carts = $_SESSION['cart'] ?? [];

        // Kiểm tra nếu có tham số `id` trên URL
        if (isset($_GET['id'])) {
            $productId = $_GET['id'];

            // Lấy thông tin sản phẩm từ cơ sở dữ liệu
            $product = (new Product())->find($productId);

            if ($product) {
                // Hiển thị sản phẩm này như một giỏ hàng tạm thời
                $carts = [
                    [
                        'id' => $product['id'],
                        'name' => $product['name'],
                        'price' => $product['price'],
                        'quantity' => 1 // Số lượng mặc định là 1
                    ]
                ];
                // Cập nhật giỏ hàng vào session
                $_SESSION['cart'] = $carts;
            }
        }

        // Tính tổng giá trị giỏ hàng
        $totalPrice = 0;
        foreach ($carts as $cart) {
            $totalPrice += $cart['price'] * $cart['quantity'];
        }

        // Hiển thị view
        return view('client.payment', compact('user', 'carts', 'totalPrice', 'categories'));
    }

    public function checkout()
    {

        // Lấy giỏ hàng từ session
        $carts = $_SESSION['cart'] ?? [];

        // Kiểm tra nếu không nhập địa chỉ hoặc số điện thoại
        if (empty($_POST['address']) || empty($_POST['phone'])) {
            return view('client.payment', [
                'error' => 'Vui lòng nhập đầy đủ địa chỉ và số điện thoại.',
                'user' => $_POST, // Trả lại dữ liệu form đã nhập
                'carts' => $carts,
                'totalPrice' => array_sum(array_map(fn($cart) => $cart['price'] * $cart['quantity'], $carts)),
                'categories' => (new Category)->all(),
            ]);
        }

        // Tính tổng giá trị giỏ hàng
        $totalPrice = array_sum(array_map(fn($cart) => $cart['price'] * $cart['quantity'], $carts));
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

        // Lấy thông tin thanh toán

        $order = [
            'user_id' => $_POST['id'],
            'status' => 1,
            'payment' => $_POST['payment'],
            'total_price' => $totalPrice,
        ];

        // Cập nhật thông tin người dùng
        (new User)->update($user['id'], $user);

        // Tạo đơn hàng
        $order_id = (new Order)->create($order);

        // Xử lý chi tiết đơn hàng
        dd($carts);
        foreach ($carts as $cart) {
            $order_detail = [
                'order_id' => $order_id,
                'product_id' => $cart['id'],
                'price' => $cart['price'],
                'quantity' => $cart['quantity'],
            ];

            (new Order)->createOrderDetail($order_detail);

            // Cập nhật số lượng sản phẩm trong kho
            $product = (new Product())->find($cart['id']);
            $newQuantity = $product['quantity'] - $cart['quantity'];
            if ($newQuantity < 0) {
                return view('client.payment_fail', ['message' => 'Sản phẩm trong kho không đủ số lượng!']);
            }
            (new Product())->updateQuantity($cart['id'], ['quantity' => $newQuantity]);
        }

        // Xử lý thanh toán VNPay
        if ($_POST['payment'] === 'vnpay') {
            $vnpay = new VNPay();
            $paymentUrl = $vnpay->createPaymentUrl($order_id, $totalPrice);
            header("Location: $paymentUrl");
            exit;
        }

        // Lưu thông tin thành công vào session

        $_SESSION['success_data'] = [
            'order_id' => $order_id,
            'total_price' => $totalPrice,
            'categories' => (new Category)->all(),
        ];

        // Xóa giỏ hàng
        $this->clearCart();
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
