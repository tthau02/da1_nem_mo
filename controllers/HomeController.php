<?php
class HomeController
{
    public function index()
    {
        $title = '';
        return view(
            'client.home',
            compact('title')
        );
    }
}
