<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    function productPage(Product $product) {
        $product['description'] = Str::markdown($product->description);
        return view('products/productpage', ['product' => $product]);
    }

    function addToCart(Product $product, Request $request) {
        if(auth()->check()) {
            $id = auth()->user()->id;
            $userCart = Cart::all()->where('user_id', $id);
            if ($userCart->count() == 0) {
                Cart::create(['user_id' => $id, 'product_id' => $product->id, 'quantity' => 1]);
            }
            else if($userCart->where('product_id', $product->id)->count() > 0) {
                $productInCart = Cart::where('product_id', $product->id)->where('user_id', $id)->first();
                $productInCart->quantity = $productInCart->quantity + 1;
                $productInCart->save();
            }
            else {
                Cart::create(['user_id' => $id, 'product_id' => $product->id, 'quantity' => 1]);
            }
        }
        else {
            if(!session('cartItems')) {
                $request->session()->push('cartItems', ['product' => $product, 'quantity' => 1]);
            }
            else {
                foreach(session('cartItems') as $index => $item) {
                    if($item['product']->id == $product->id) {
                        $quantity = $item['quantity'] + 1;

                        $cartItems = session('cartItems');
                        $cartItems[$index] = ['product' => $product, 'quantity' => $quantity];
                        $request->session()->forget('cartItems');
                        $request->session()->push('cartItems', $cartItems[0]);
                        return back()->with('cartSuccess', 'This item has been added to your cart!');
                    }
                }
                $request->session()->push('cartItems', ['product' => $product, 'quantity' => 1]);
            }
        }
        return back()->with('cartSuccess', 'This item has been added to your cart!');
    }

    function createProductForm() {
        $categories = Category::all();
        return view('products/create-product', ['categories' => $categories]);
    }
    function createProduct(Request $request) {
        $createProductFormData = $request->validate([
            'name' => ['required', 'min:2', 'max:100'],
            'description' => ['required', 'min:2', 'max:500'],
            'price' => ['required'],
            'category' => ['required'],
            'discount' => [],
        ]);
        $createProductFormData['name'] = strip_tags($createProductFormData['name']);
        $createProductFormData['description'] = strip_tags($createProductFormData['description']);
        $slugName = Str::slug($createProductFormData['name']) . '-' . substr(bin2hex(random_bytes(4)), 0, 8);
        $createProductFormData['slug'] = $slugName;
        $createProductFormData['price'] = strip_tags($createProductFormData['price']);
        $createProductFormData['discount'] = $createProductFormData['discount'] == null ? 0.00 : strip_tags($createProductFormData['discount']);
        $createProductFormData['category_id'] = $createProductFormData['category'];

        $productImg = Image::make($request->file('image'))
            ->resize(500, 800, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
            })
            ->encode('jpg');
        $imageName = $slugName . '-image.jpg';
        Storage::put('public/product-images/' . $imageName, $productImg);
        $createProductFormData['image'] = $imageName;

        $productThmb = Image::make($request->file('image'))
            ->resize(80, 120, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
            })
            ->encode('jpg');
        $thumbnailName = $slugName . '-thumbnail.jpg';
        Storage::put('public/product-images/' . $thumbnailName, $productThmb);
        $createProductFormData['thumbnail'] = $thumbnailName;

        $newProduct = Product::create($createProductFormData);

        return redirect("/product/{$newProduct->slug}")->with('success', 'New product successfully created.');
    }

    function manageProducts() {
        $products = Product::all();
        $categories = Category::all();
        return view('products/manage-products', ['products' => $products, 'categories' => $categories]);
    }

    function ChangeProductImage(Product $product) {
        $product['description'] = Str::markdown($product->description);
        return view('products/change-product-image', ['product' => $product]);
    }

    function saveNewProductImage(Product $product, Request $request) {

        $productImg = Image::make($request->file('image'))
            ->resize(500, 800, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
            })
            ->encode('jpg');
        $newImageName = $product['slug'] . '-image.jpg';

        $productThmb = Image::make($request->file('image'))
            ->resize(80, 120, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
            })
            ->encode('jpg');
        $newThumbnailName = $product['slug'] . '-thumbnail.jpg';

        $oldImage = $product->image;
        $oldThumbnail = $product->thumbnail;
        if (!empty($oldImage) && $oldImage != 'no-image.jpg') {
            Storage::delete('public/product-images/' . $oldImage);
        }
        if (!empty($oldThumbnail) && $oldThumbnail != 'no-image.jpg') {
            Storage::delete('public/product-images/' . $oldThumbnail);
        }

        Storage::put('public/product-images/' . $newImageName, $productImg);
        Storage::put('public/product-images/' . $newThumbnailName, $productThmb);
        $product->image = $newImageName;
        $product->thumbnail = $newThumbnailName;
        $product->save();

        return back()->with('success', 'Product image successfully changed.');
    }

    function editProductDetails(Product $product) {
        $productCategory = Category::find($product->category_id);
        $otherCategories = Category::all()->where('id', '!=', $product->category_id);
        return view('products/edit-product-details', ['product' => $product, 'productCategory' => $productCategory, 'otherCategories' => $otherCategories]);
    }

    function saveNewDetails(Product $product, Request $request) {
        $editProductFormData = $request->validate([
            'name' => ['required', 'min:2', 'max:100'],
            'description' => ['required', 'min:2', 'max:500'],
            'price' => ['required'],
            'discount' => [],
            'category' => ['required'],
            'id' => [],
        ]);
        $editProductFormData['name'] = strip_tags($editProductFormData['name']);
        $editProductFormData['description'] = strip_tags($editProductFormData['description']);
        $editProductFormData['price'] = strip_tags($editProductFormData['price']);
        $editProductFormData['discount'] = $editProductFormData['discount'] == null ? 0.00 : strip_tags($editProductFormData['discount']);
        $editProductFormData['category_id'] = $editProductFormData['category'];

        if ($product->name != $editProductFormData['name']) {
            $newSlug = Str::slug($editProductFormData['name']) . '-' . substr(bin2hex(random_bytes(4)), 0, 8);
            $newImageName = $newSlug . '-image.jpg';
            Storage::move('public/product-images/' . $product->image, 'public/product-images/' . $newImageName);
            $newThumbnailName = $newSlug . '-thumbnail.jpg';
            Storage::move('public/product-images/' . $product->thumbnail, 'public/product-images/' . $newThumbnailName);

            $editProductFormData['slug'] = $newSlug;
            $editProductFormData['image'] = $newImageName;
            $editProductFormData['thumbnail'] = $newThumbnailName;
        }

        $product->update($editProductFormData);

        return redirect('/edit-product/' . $product->slug . '/')->with('success', 'Product details successfully changed.');

    }

    function deleteProduct(Product $product) {
        if (!empty($product->image) && $product->image != 'no-image.jpg') {
            Storage::delete('public/product-images/' . $product->image);
        }
        if (!empty($product->thumbnail) && $product->thumbnail != 'no-image.jpg') {
            Storage::delete('public/product-images/' . $product->thumbnail);
        }
        $product->delete();
        return redirect("/manage-products/")->with('success', 'Product successfully deleted.');
    }
}
