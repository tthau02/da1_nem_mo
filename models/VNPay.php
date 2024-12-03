<?php

class VNPay extends BaseModel
{
  private $vnp_TmnCode = "58KTWJDD"; //Mã định danh merchant kết nối (Terminal Id)
  private $vnp_HashSecret = "YAE2K1BHKRUHW9I6FPB0ISRCFBE0S1GI"; //Secret key
  private $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // URL thanh toán VNPay
  private $vnp_Returnurl = "http://localhost/da1-nem-mo/vnpay_php/vnpay_return.php";
  // URL callback sau thanh toán

  public function createPaymentUrl($order_id, $total_price)
  {
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

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
      $vnp_Params['vnp_BankCode'] = $vnp_BankCode;
    }
    // Sắp xếp mảng theo thứ tự tăng dần
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
      $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
      $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    // dd($vnp_Url);
    // die;

    return $vnp_Url;
  }


  public function handleCallback($inputData)
  {
    $vnp_SecureHash = $inputData['vnp_SecureHash'];
    unset($inputData['vnp_SecureHash']);
    unset($inputData['vnp_SecureHashType']);

    ksort($inputData);
    $hashdata = "";
    foreach ($inputData as $key => $value) {
      $hashdata .= $key . "=" . $value . "&";
    }
    $hashdata = rtrim($hashdata, "&");

    // Kiểm tra chữ ký bảo mật
    $secureHash = hash_hmac('sha512', $hashdata, $this->vnp_HashSecret);
    if ($secureHash === $vnp_SecureHash) {
      // Trả về dữ liệu giao dịch
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

  /**
   * Lưu thông tin giao dịch vào CSDL.
   * 
   * @param array $data Dữ liệu giao dịch
   */
  public function saveTransaction($data)
  {
    $sql = "INSERT INTO vnpay (order_id, transaction_id, amount, status, payment_date) 
                VALUES (:order_id, :transaction_id, :amount, :status, :payment_date)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute($data);
  }
}
