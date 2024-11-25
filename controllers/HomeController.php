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
        return view(
            'client.home',
            compact('categories', 'newProduct', 'title','totalQuantity' , 'topProducts')
        );
    }
}
