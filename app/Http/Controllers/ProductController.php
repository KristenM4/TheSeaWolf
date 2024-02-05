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
            'price' => ['required', 'image', 'max:8000'],
            'discount' => []
        ]);
        $request->file('image')->store('public/product_images');
        $createProductFormData['name'] = strip_tags($createProductFormData['name']);
        $createProductFormData['description'] = strip_tags($createProductFormData['description']);
        $createProductFormData['slug'] = Str::slug($createProductFormData['name']);
        $createProductFormData['price'] = strip_tags($createProductFormData['price']);
        $createProductFormData['discount'] = $createProductFormData['discount'] == null ? 0.00 : strip_tags($createProductFormData['discount']);

        $newProduct = Product::create($createProductFormData);

        return redirect("/product/{$newProduct->id}")->with('success', 'New product successfully created.');
    }
}
