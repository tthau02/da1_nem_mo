<?php
class CartController
{

  public function addCart()
  {

    if (!isset($_SESSION['user_id'])) {

      $_SESSION['error'] = "Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.";
      header("Location: " . ROOT_URL . "?ctl=login");
      exit();
    }



    $carts = $_SESSION['cart'] ?? [];
    $id = $_GET['id'] ?? null; // Lấy ID sản phẩm từ GET





    // Lấy sản phẩm theo ID
    $product = (new Product())->find($id);



    $cartQuantity = isset($carts[$id]) ? $carts[$id]['quantity'] : 0;
    $totalRequested = $cartQuantity + 1;

    if ($totalRequested > $product['quantity']) {

      return view('client.payment_fail', ['message' => 'Sản phẩm trong kho không đủ số lượng!']);
    }

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


    // $_SESSION['totalQuantity'] = $this->totalQuantityCart();
    // Lấy URI hoặc gán giá trị mặc định
    $uri = $_SESSION['URI'] ?? $_SERVER['HTTP_REFERER'] ?? ROOT_URL;
    header("Location: " . $uri);
    exit();
  }

  // Tính tổng số lượng sản phẩm trong giỏ hàng
  public function totalQuantityCart()
  {
    //Lấy giỏ hàng từ session:
    $carts = $_SESSION['cart'] ?? [];
    $totalQuantity = 0;

    foreach ($carts as $cart) {
      $totalQuantity += $cart['quantity'];
    }

    return $totalQuantity;
  }

  public function showCart()
  {
    //Lấy giỏ hàng từ session:
    $title = 'Giỏ Hàng';

    $carts = $_SESSION['cart'] ?? [];
    $totalQuantity = $this->totalQuantityCart();
    $totalPrice = 0;

    foreach ($carts as $cart) {
      $totalPrice += $cart['price'] * $cart['quantity'];
    }

    return view(
      'client.cart',
      compact('title', 'carts', 'totalQuantity', 'totalPrice')


    );
  }

  public function removeCart()
  {
    $id = $_GET['id'] ?? null;
    $carts = $_SESSION['cart'] ?? [];

    if ($id && isset($carts[$id])) {
      unset($carts[$id]);
    }

    $_SESSION['cart'] = $carts;
    $uri = $_SERVER['HTTP_REFERER'] ?? ROOT_URL;
    header("Location: " . $uri);
    exit();
  }

  public function inCreaseQuantity()
  {
    $id = $_GET['id'] ?? null;
    $carts = $_SESSION['cart'] ?? [];

    if ($id && isset($carts)) {
      $carts[$id]['quantity']++;
    }

    $_SESSION['cart'] = $carts;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }

  public function deCreaseQuantity()
  {
    $id = $_GET['id'] ?? null;
    $carts = $_SESSION['cart'] ?? [];

    if ($id && isset($carts)) {
      $carts[$id]['quantity']--;
      if ($carts[$id]['quantity'] <= 0) {
        unset($carts[$id]);
      }
    }

    $_SESSION['cart'] = $carts;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
}
