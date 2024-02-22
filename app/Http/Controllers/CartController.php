<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    function cartPage(Request $request) {
        if(auth()->check()) {
            $cart = Cart::find(auth()->user()->id);
            $cartItems = $cart->getProducts;
        }
        else{
            $cartItems = session('cartItems');
        }
        return view('cart/cartpage', ['cartitems' => $cartItems]);
    }

    function cartIncrement(Product $product, Request $request) {
        if(auth()->check()) {
            $cartItem = Cart::where('user_id', auth()->user()->id)->where('product_id', $product->id)->first();
            $cartItem->quantity = $cartItem->quantity + 1;
            $cartItem->save();
        }
        else{
            foreach(session('cartItems') as $index => $item) {
                if($item['product']->id == $product->id) {
                    $quantity = $item['quantity'] + 1;

                    $cartItems = session('cartItems');
                    $cartItems[$index] = ['product' => $product, 'quantity' => $quantity];
                    $request->session()->forget('cartItems');
                    $request->session()->push('cartItems', $cartItems[0]);
                }
            }
        }
        return back();
    }

    function cartDecrement(Product $product, Request $request) {
        if(auth()->check()) {
            $cartItem = Cart::where('user_id', auth()->user()->id)->where('product_id', $product->id)->first();
            if($cartItem->quantity > 1) {
                $cartItem->quantity = $cartItem->quantity - 1;
                $cartItem->save();
            }
            else {
                $cartItem->delete();
            }
        }
        else{
            foreach(session('cartItems') as $index => $item) {
                if($item['product']->id == $product->id) {
                    if($item['quantity'] > 1) {
                        $quantity = $item['quantity'] - 1;
                        $cartItems = session('cartItems');
                        $cartItems[$index] = ['product' => $product, 'quantity' => $quantity];
                        $request->session()->forget('cartItems');
                        $request->session()->push('cartItems', $cartItems[0]);
                    }
                    else {
                        $cartItems = session('cartItems');
                        unset($cartItems[$index]);
                        $request->session()->forget('cartItems');
                        empty($cartItems) ? :  $request->session()->push('cartItems', $cartItems[0]);
                    }
                }
            }
        }
        return back();
    }
}
