<?php
class HomeController
{
    public function index()
    {
        $categories = ['name' => 'Bóng đá', 'description' => 'Trang bóng đá'];
        return view("client.home", ['categories' => $categories]);
    }
}
