<?php

class ProductController
{
    public function all()
    {
        $title = 'Sản Phẩm';
        $product = new Product;

        $limit = 15;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Mặc định là trang 1 nếu không có tham số
        $offset = ($page - 1) * $limit;

        // Lấy danh sách sản phẩm và tổng số sản phẩm
        $products = $product->all($limit, $offset);
        $totalProducts = $product->count();
        $totalPages = max(ceil($totalProducts / $limit), 1);

        $categories = (new Category)->all();
        $totalQuantity = (new CartController)->totalQuantityCart();

        return view(
            'client.products.list',
            compact('categories', 'products', 'title', 'totalQuantity', 'page', 'totalPages')
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
        $category = (new Category)->find($categoryId);
        $title = $product['name'] ?? '';
        $categories = (new Category)->all();
        $users = (new User)->all();

        $comments = (new Comment)->getCommentByProductId($id);


        // Lưu URI vào session
        $_SESSION['URI'] = $_SERVER['REQUEST_URI'];


        $totalQuantity = (new CartController)->totalQuantityCart();

        return view(
            'client.products.detail',
            compact('product', 'users', 'category', 'categories', 'title', 'comments', 'totalQuantity', 'relatedProducts')

        );
    }

    public function filter()
    {
        $title = 'Sản Phẩm';
        $product = new Product;

        // Lấy tham số từ GET
        $minPrice = isset($_GET['min_price']) ? (int)$_GET['min_price'] : 0;
        $maxPrice = isset($_GET['max_price']) ? (int)$_GET['max_price'] : PHP_INT_MAX;
        $rating = isset($_GET['rating']) ? (int)$_GET['rating'] : null;

        // Số sản phẩm mỗi trang
        $limit = 15;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Lọc sản phẩm
        $products = $product->filterProducts($minPrice, $maxPrice, $rating, $limit, $offset);
        $totalProducts = $product->countFilteredProducts($minPrice, $maxPrice, $rating);
        $totalPages = max(ceil($totalProducts / $limit), 1);

        // Lấy danh mục sản phẩm
        $categories = (new Category)->all();

        // Lấy tổng số lượng sản phẩm trong giỏ hàng
        $totalQuantity = (new CartController)->totalQuantityCart();

        // Gửi dữ liệu tới view
        return view(
            'client.products.list',
            compact('categories', 'products', 'title', 'totalQuantity', 'page', 'totalPages')
        );
    }
}
