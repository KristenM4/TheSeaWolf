<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    function productPage(Product $product) {
        $product['description'] = Str::markdown($product->description);
        return view('products/productpage', ['product' => $product]);
    }

    function createProductForm() {
        return view('products/create-product');
    }
    function createProduct(Request $request) {
        $createProductFormData = $request->validate([
            'name' => ['required', 'min:2', 'max:100'],
            'description' => ['required', 'min:2', 'max:500'],
        ]);
        $createProductFormData['name'] = strip_tags($createProductFormData['name']);
        $createProductFormData['description'] = strip_tags($createProductFormData['description']);

        $newProduct = Product::create($createProductFormData);

        return redirect("/product/{$newProduct->id}")->with('success', 'New product successfully created.');
    }
}
