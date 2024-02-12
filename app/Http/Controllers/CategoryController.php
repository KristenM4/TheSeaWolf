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
}
