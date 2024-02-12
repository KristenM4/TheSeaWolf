<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function createCategoryForm() {
        return view('category/create-category');
    }

    function createCategory(Request $request) {
        $createCategoryFormData = $request->validate([
            'name' => ['required', 'min:2', 'max:100']
        ]);
        $createCategoryFormData['name'] = strip_tags($createCategoryFormData['name']);

        $newCategory = Category::create($createCategoryFormData);

        return redirect("/manage-products/")->with('success', 'New category successfully created.');
    }
}
