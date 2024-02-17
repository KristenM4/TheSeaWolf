<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function homepage() {
        $categories = Category::all()->where('numProducts', '>', 0);
        $products = Product::paginate(6);
        return view('homepage', ['products' => $products, 'categories' => $categories]);
    }
}
