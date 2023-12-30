<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function homepage() {
        $products = DB::table('products')->get();
        return view('homepage', ['products' => $products]);
    }
}
