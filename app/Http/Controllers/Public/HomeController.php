<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home');
    }

    public function cart()
    {
        return view('pages.cart');
    }

    public function checkout()
    {
        return view('pages.checkout');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function detail()
    {
        return view('pages.detail');
    }

        
    public function shop()
    {
        return view('pages.shop');
    }
}
