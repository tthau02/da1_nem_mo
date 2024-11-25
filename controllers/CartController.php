<?php
class CartController
{

  public function addCart()
  {


    $carts = $_SESSION['cart'] ?? []; // Tạo giỏ hàng nếu chưa có
    $id = $_GET['id'] ?? null; // Lấy ID sản phẩm từ GET

    // Kiểm tra ID hợp lệ


    // Lấy sản phẩm theo ID
    $product = (new Product())->find($id);


    // Kiểm tra sản phẩm có trong giỏ hàng
    if (isset($carts[$id])) {
      $carts[$id]['quantity'] += 1;
    } else {
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
  public function totalQuantityCart()
  {
    $carts = $_SESSION['cart'] ?? [];
    $totalQuantity = 0;

    foreach ($carts as $cart) {
      $totalQuantity += $cart['quantity'];
    }

    return $totalQuantity;
  }

    public function showCart(){
        $carts = $_SESSION['cart'] ?? [];
        $totalQuantity = $this->totalQuantityCart();
        $totalPrice =0;

      foreach($carts as $cart){
           $totalPrice += $cart['price'] * $cart['quantity'];
      }

      $data = [
        'carts' => $carts,
        'totalQuantity' => $totalQuantity,
        'totalPrice' => $totalPrice
      ];

        return view('client.cart', $data);
    }

    public function removeCart(){
        $id = $_GET['id'] ?? null;
        $carts = $_SESSION['cart'] ?? [];

        if($id && isset($carts[$id])){
          unset($carts[$id]);
        }

        $_SESSION['cart'] = $carts;
        $uri = $_SERVER['HTTP_REFERER'] ?? ROOT_URL;
        header("Location: " . $uri);
        exit(); 

    }

    public function inCreaseQuantity(){
      $id = $_GET['id'] ?? null;
      $carts = $_SESSION['cart'] ?? [];

      if($id && isset($carts)){
        $carts[$id]['quantity'] ++;
      }

      $_SESSION['cart'] = $carts;
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function deCreaseQuantity(){
      $id = $_GET['id'] ?? null;
      $carts = $_SESSION['cart'] ?? [];

      if($id && isset($carts)){
        $carts[$id]['quantity'] --;
        if($carts[$id]['quantity'] <=0){
          unset($carts[$id]);
        }
      }

      $_SESSION['cart'] = $carts;
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
