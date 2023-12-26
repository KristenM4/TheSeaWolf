<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
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

        Product::create($createProductFormData);

        return redirect('/')->with('success', 'New product successfully created.');
    }
}
