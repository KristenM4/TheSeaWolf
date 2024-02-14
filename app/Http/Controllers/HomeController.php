<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function homepage() {
        $products = Product::all();
        return view('homepage', ['products' => $products]);
    }
}
