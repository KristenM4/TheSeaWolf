<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

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
            'price' => ['required'],
            'discount' => [],
        ]);
        $createProductFormData['name'] = strip_tags($createProductFormData['name']);
        $createProductFormData['description'] = strip_tags($createProductFormData['description']);
        $slugName = Str::slug($createProductFormData['name']) . '-' . substr(bin2hex(random_bytes(4)), 0, 8);
        $createProductFormData['slug'] = $slugName;
        $createProductFormData['price'] = strip_tags($createProductFormData['price']);
        $createProductFormData['discount'] = $createProductFormData['discount'] == null ? 0.00 : strip_tags($createProductFormData['discount']);

        $productImg = Image::make($request->file('image'))
            ->resize(500, 800, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
            })
            ->encode('jpg');
        $imageName = $slugName . '-image.jpg';
        Storage::put('public/product-images/' . $imageName, $productImg);
        $createProductFormData['image'] = $imageName;

        $newProduct = Product::create($createProductFormData);

        return redirect("/product/{$newProduct->id}")->with('success', 'New product successfully created.');
    }

    function manageProducts() {
        $products = DB::table('products')->get();
        return view('products/manage-products', ['products' => $products]);
    }
}
