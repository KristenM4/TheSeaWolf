<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    function cartPage() {
        $cartItems = session('cartItems');
        return view('cart/cartpage', ['cartitems' => $cartItems]);
    }
}
