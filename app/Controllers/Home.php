<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $userSession = session()->get('user');
        $data = [
            'isLogin' => $userSession ? true : false
        ];
        return view('pages/home', $data);
    }
    public function about(): string
    {
        return view('pages/about');
    }
}
