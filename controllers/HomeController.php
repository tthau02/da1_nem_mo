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

    public function intro(){
        $title = "Giới thiệu - Nệm Mơ";
        $categories = (new Category)->all();
        return view(
            'client.Introduce',
            compact('title', 'categories')
        );
    }

    public function contact(){
        $title = "Liên Hệ - Nệm Mơ";
        $categories = (new Category)->all();
        return view(
            'client.contact',
            compact('title', 'categories')
        );
    }

    public function policy(){
        $title = "Chính Sách - Nệm Mơ";
        $categories = (new Category)->all();
        return view(
            'client.policy',
            compact('title', 'categories')
        );
    }
}
