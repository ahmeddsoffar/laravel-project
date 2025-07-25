<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function viewCategory()
    {
        return view("adminViews.createCategory");
    }
    public function storeCategory()
    {
        request()->validate(
            ['name' => 'required'],
            [
                'name.required' => 'The category name is required.',
            ]
        );
        Category::create(["name" => request('name')]);
        return redirect()->route('category.list')->with('success', 'Category created successfully!');
    }

    public function listCategories()
    {
        $categories = Category::all();
        return view("adminViews.listCategories", compact('categories'));
    }

   
    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view("adminViews.editCategory", compact('category'));
    }

    public function updateCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->update(['name'=>request('name')]);
        return redirect()->route('adminViews.listCategories')->with('success', 'Category updated successfully!');
    }
    
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('adminViews.listCategories')->with('success', 'Category deleted successfully!');
    }

    
}
