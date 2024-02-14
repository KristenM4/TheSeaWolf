<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function categoryPage(Category $category) {
        $products = Product::all()->where('category_id', $category->id);
        return view('category/category-page', ['category' => $category, 'products' => $products]);
    }

    function createCategoryForm() {
        return view('category/create-category');
    }

    function createCategory(Request $request) {
        $createCategoryFormData = $request->validate([
            'name' => ['required', 'min:2', 'max:100']
        ]);
        $createCategoryFormData['name'] = strip_tags($createCategoryFormData['name']);

        Category::create($createCategoryFormData);

        return redirect("/manage-products/")->with('success', 'New category successfully created.');
    }

    function editCategoryDetails(Category $category) {
        return view('category/edit-category-details', ['category' => $category]);
    }

    function saveNewDetails(Category $category, Request $request) {
        $editCategoryFormData = $request->validate([
            'name' => ['required', 'min:2', 'max:100'],
            'id' => [],
        ]);
        $editCategoryFormData['name'] = strip_tags($editCategoryFormData['name']);
        $category->update($editCategoryFormData);

        return back()->with('success', 'Category details successfully changed.');
    }

    function deleteCategory(Category $category) {
        Product::where('category_id', $category->id)->update(['category_id' => 0]);
        $category->delete();
        return redirect("/manage-products/")->with('success', 'Category successfully deleted.');
    }
}
