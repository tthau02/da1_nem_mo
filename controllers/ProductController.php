<?php

class ProductController{
    public function all(){
        $title = 'Sản Phẩm';
        $product = new Product;
        $products = $product->all();

        $categories = (new Category)->all();
        return view(
            'client.products.list',
            compact('categories', 'products', 'title')
        );
    }

    public function getProductByCategory(){
        $id = $_GET['id'];
        $products = (new Product)->listProductInCategory($id);

        $title = '';
        if ($products) {
            $title = $products[0]['cate_name'];
        }
        $categories = (new Category)->all();
        return view(
            'client.products.list',
            compact('categories', 'products', 'title')
        );
    }

    public function detail(){
        $id = $_GET['id'];

        $product = (new Product)->find($id);
        $title = $product['name'] ?? '';
        $categories = (new Category)->all();

        return view(
            'client.products.detail',
            compact('product', 'categories', 'title')
        );
    }
}


?>