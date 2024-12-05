<?php

class VNPay extends BaseModel
{
  private $vnp_TmnCode = "58KTWJDD"; // Mã định danh merchant kết nối (Terminal Id)
  private $vnp_HashSecret = "J5DR678SR08ADCQ5IPOB6GIRW2XKH0PY"; // Secret key
  private $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // URL thanh toán VNPay
  private $vnp_Returnurl = "http://localhost/da1-nem-mo/index.php?ctl=vnpay-callback"; // URL callback sau thanh toán

  // Hàm tạo URL thanh toán
  public function createPaymentUrl($order_id, $total_price)
  {
    $vnp_HashSecret = $this->vnp_HashSecret;
    $startTime = date("YmdHis");
    $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

    $vnp_Params = array(
      "vnp_Version" => "2.1.0",
      "vnp_TmnCode" => $this->vnp_TmnCode,
      "vnp_Amount" => $total_price * 100, // Quy đổi VNPay: VNĐ x 100
      "vnp_Command" => "pay",
      "vnp_CreateDate" => $startTime,
      "vnp_CurrCode" => "VND",
      "vnp_IpAddr" => $_SERVER['REMOTE_ADDR'],
      "vnp_Locale" => "vn",
      "vnp_OrderInfo" => "Thanh toán đơn hàng #" . $order_id,
      "vnp_OrderType" => "billpayment",
      "vnp_ReturnUrl" => $this->vnp_Returnurl,
      "vnp_TxnRef" => $order_id,
      "vnp_ExpireDate" => $expire
    );

    // Sắp xếp mảng tham số theo thứ tự tăng dần
    ksort($vnp_Params);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($vnp_Params as $key => $value) {
      if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
      } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
      }
      $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $this->vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
      // Tính toán hash bảo mật
      $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
      $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }

    return $vnp_Url;
  }

  // Hàm xử lý callback
  public function handleCallback($inputData)
  {
    // Lấy giá trị của vnp_SecureHash từ callback trả về
    $vnp_SecureHash = $_GET['vnp_SecureHash'];
    $inputData = array();
    foreach ($_GET as $key => $value) {
      if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
      }
    }

    unset($inputData['vnp_SecureHash']);
    ksort($inputData);
    $i = 0;
    $hashData = "";
    foreach ($inputData as $key => $value) {
      if ($i == 1) {
        $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
      } else {
        $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
        $i = 1;
      }
    }

    $secureHash = hash_hmac('sha512', $hashData, $this->vnp_HashSecret);
    // So sánh chữ ký bảo mật từ VNPay và chữ ký tính toán
    if ($secureHash === $vnp_SecureHash) {
      // Xác thực trạng thái giao dịch
      $transactionData = [
        'order_id' => $inputData['vnp_TxnRef'],
        'amount' => $inputData['vnp_Amount'],
        'bank_code' => $inputData['vnp_BankCode'] ?? '',
        'bank_tranno' => $inputData['vnp_BankTranNo'] ?? '',
        'card_type' => $inputData['vnp_CardType'] ?? '',
        'order_info' => $inputData['vnp_OrderInfo'] ?? '',
        'paydate' => $inputData['vnp_PayDate'] ?? '',
        'tmn_code' => $this->vnp_TmnCode,
        'transaction_no' => $inputData['vnp_TransactionNo'] ?? '',
        'status' => $inputData['vnp_ResponseCode'] === '00' ? 'success' : 'fail', // Trạng thái giao dịch
      ];

      // Lưu thông tin giao dịch vào CSDL
      $this->saveTransaction($transactionData);

      return [
        'status' => $inputData['vnp_ResponseCode'] === '00' ? 'success' : 'fail',
        'data' => $inputData,
      ];
    }

    // Trả về giao dịch không hợp lệ
    return [
      'status' => 'invalid',
      'message' => 'Chữ ký không hợp lệ',
    ];
  }

  // Hàm lưu thông tin giao dịch vào cơ sở dữ liệu
  public function saveTransaction($data)
  {
    // Kiểm tra dữ liệu đầu vào (tùy chọn)
    // Câu lệnh SQL
    $sql = "INSERT INTO vnpay (order_id, amount, bank_code, bank_tranno, card_type, order_info, paydate, tmn_code, transaction_no) 
            VALUES (:order_id, :amount, :bank_code, :bank_tranno, :card_type, :order_info, :paydate, :tmn_code, :transaction_no)";

    // Chuẩn bị câu lệnh SQL
    $stmt = $this->conn->prepare($sql);

    // Bind tham số
    $stmt->bindParam(':order_id', $data['order_id']);
    $stmt->bindParam(':amount', $data['amount']);
    $stmt->bindParam(':bank_code', $data['bank_code']);
    $stmt->bindParam(':bank_tranno', $data['bank_tranno']);
    $stmt->bindParam(':card_type', $data['card_type']);
    $stmt->bindParam(':order_info', $data['order_info']);
    $stmt->bindParam(':paydate', $data['paydate']);
    $stmt->bindParam(':tmn_code', $data['tmn_code']);
    $stmt->bindParam(':transaction_no', $data['transaction_no']);

    // Thực thi câu lệnh
    $stmt->execute();
  }
}
