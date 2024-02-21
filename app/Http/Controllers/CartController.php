<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;

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

    function cartIncrement(Product $product) {
        if(auth()->check()) {
            $cartItem = Cart::where('user_id', auth()->user()->id)->where('product_id', $product->id)->first();
            $cartItem->quantity = $cartItem->quantity + 1;
            $cartItem->save();
        }
        else{
            $cartItems = session('cartItems');
            foreach($cartItems as $item) {
                if($item['product']->name == $product->name) {
                    $item['quantity'] = $item['quantity'] + 1;
                }
            }
        }
        return back();
    }
}
