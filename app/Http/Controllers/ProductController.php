<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    function createProductForm() {
        return view('products/create-product');
    }
}
