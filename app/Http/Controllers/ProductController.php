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
        $products = Product::all();
        return view('products/manage-products', ['products' => $products]);
    }

    function ChangeProductImage(Product $product) {
        $product['description'] = Str::markdown($product->description);
        return view('products/change-product-image', ['product' => $product]);
    }

    function saveNewProductImage(Request $request) {
        $changeImageFormData = $request->validate([
            'id' => [],
        ]);

        $product = Product::find($changeImageFormData['id']);

        $productImg = Image::make($request->file('image'))
            ->resize(500, 800, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
            })
            ->encode('jpg');
        $newImageName = $product['slug'] . '-image.jpg';

        $oldImage = $product->image;
        if (!empty($oldImage) && $oldImage != 'no-image.jpg') {
            Storage::delete('public/product-images/' . $oldImage);
        }

        Storage::put('public/product-images/' . $newImageName, $productImg);
        $product->image = $newImageName;
        $product->save();

        return redirect("/manage-products/")->with('success', 'Product image successfully changed.');
    }

    function editProductDetails(Product $product) {
        return view('products/edit-product-details', ['product' => $product]);
    }

    function saveNewDetails(Request $request) {
        $editProductFormData = $request->validate([
            'name' => ['required', 'min:2', 'max:100'],
            'description' => ['required', 'min:2', 'max:500'],
            'price' => ['required'],
            'discount' => [],
            'id' => [],
        ]);
        $editProductFormData['name'] = strip_tags($editProductFormData['name']);
        $editProductFormData['description'] = strip_tags($editProductFormData['description']);
        $editProductFormData['price'] = strip_tags($editProductFormData['price']);
        $editProductFormData['discount'] = $editProductFormData['discount'] == null ? 0.00 : strip_tags($editProductFormData['discount']);

        $product = Product::find($editProductFormData['id']);

        $product->name = $editProductFormData['name'];
        $product->description = $editProductFormData['description'];
        $product->price = $editProductFormData['price'];
        $product->discount = $editProductFormData['discount'];
        $product->save();

        return redirect("/manage-products/")->with('success', 'Product details successfully changed.');
    }
}
