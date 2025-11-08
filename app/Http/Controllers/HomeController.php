<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class HomeController extends Controller
// {
//     public function index(){
//         return view("home.index");
//     }
// }


namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $featured_products = Product::where('XOA', 0)
            ->orderBy('GIA', 'asc')
            ->take(5)
            ->get();

        return view('home.index', compact('featured_products'));
        // return view('home.index', compact('products'));
    }
}
