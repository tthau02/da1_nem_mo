<?php
class HomeController
{
    public function index()
    {
        $title = '';
        $categories = (new Category)->all();
        return view(
            'client.home',
            compact('categories', 'title')
        );
    }
}
