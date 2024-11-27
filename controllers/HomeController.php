<?php
class HomeController
{
    public function index()
    {
        $title = 'Mện Mơ';
        $product = new Product;
        $newProduct = $product->getProductNew(8);
        $categories = (new Category)->all();
        $totalQuantity = (new CartController)->totalQuantityCart();
        $topProducts = (new Product)->getTopRatedProducts(8);

        // Lưu URI vào session
        $_SESSION['URI'] = $_SERVER['REQUEST_URI'];
        return view(
            'client.home',
            compact('categories', 'newProduct', 'title','totalQuantity' , 'topProducts')
        );
    }
}
