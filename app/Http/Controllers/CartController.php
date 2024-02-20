<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    function cartPage(Request $request) {
        return 'this is your cart';
    }
}
