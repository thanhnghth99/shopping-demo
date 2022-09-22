<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all()->sortBy('name');
        $latestProducts = Product::where('status', Product::STATUS_ENABLE)->latest()->take(4)->get();
        
        return view('pages.home', compact('categories', 'latestProducts'));
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
        $products = Product::where('status', Product::STATUS_ENABLE)->latest()->get();
        $categories = Category::all()->sortBy('name');
        $colors = Color::all()->sortBy('name');
        $sizes = Size::all()->sortBy('name');
        // dd($colors[0]->products->count());

        return view('pages.shop', compact('products', 'colors', 'sizes', 'categories'));
    }
}
