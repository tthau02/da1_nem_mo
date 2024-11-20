<?php

class ProductController
{
    public function all()
    {
        $title = 'Sản Phẩm';
        $product = new Product;
        $products = $product->all();

        $categories = (new Category)->all();
        $totalQuantity = (new CartController)->totalQuantityCart();

        return view(
            'client.products.list',
            compact('categories', 'products', 'title', 'totalQuantity')
        );
    }

    public function getProductByCategory()
    {
        $id = $_GET['id'];
        $products = (new Product)->listProductInCategory($id);

        $title = '';
        if ($products) {
            $title = $products[0]['cate_name'];
        }
        $categories = (new Category)->all();
        $totalQuantity = (new CartController)->totalQuantityCart();
        return view(
            'client.products.list',
            compact('categories', 'products', 'title', 'totalQuantity')
        );
    }

    public function detail()
    {
        $id = $_GET['id'];
        $product = (new Product)->find($id);
        $categoryId = $product['category_id'] ?? null;
        $relatedProducts = (new Product)->productInCategory($categoryId, $id);

        $title = $product['name'] ?? '';
        $categories = (new Category)->all();
        $users = (new User)->all();

        $comments = (new Comment)->getCommentByProductId($id);


        // Lưu URI vào session
        $_SESSION['URI'] = $_SERVER['REQUEST_URI'];


        $totalQuantity = (new CartController)->totalQuantityCart();

        return view(
            'client.products.detail',
            compact('product', 'users', 'categories', 'title', 'comments', 'totalQuantity', 'relatedProducts')

        );
    }
}
