<?php

namespace App\Http\Controllers;

use App\Models\Cart;

class CartController extends Controller
{
    function cartPage() {
        if(auth()->check()) {
            $cart = Cart::find(auth()->user()->id);
            $cartItems = $cart->getProducts;
        }
        else{
            $cartItems = session('cartItems');
        }
        return view('cart/cartpage', ['cartitems' => $cartItems]);
    }
}
