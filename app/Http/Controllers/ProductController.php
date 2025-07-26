<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function viewProduct()
    {
        // Logic to show the form for adding a new product
        $categories = Category::all(); // Assuming you have a Category model
        return view('adminViews.createProduct', compact('categories'));
    }

    public function storeProduct()
    {
        // Validate input
        request()->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'category' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        // Handle image upload if present
        $imagePath = null;
        if (request()->hasFile('image')) {
            $image = request()->file('image');
            $imagePath = $image->store('products', 'public');
        }

        // Create product with correct category_id
        $product = Product::create([
            'name' => request('name'),
            'description' => request('description'),
            'price' => request('price'),
            'quantity' => request('quantity'),
            'discount' => request('discount') ?? 0,
            'category_id' => request('category'),
            'image' => $imagePath,
        ]);

        return redirect()->route('product.list')->with('success', 'Product added successfully');
    }

    public function listProducts()
    {
        $products = Product::all();
        //$categories = Category::all();
        return view('adminViews.listProducts', compact('products'));
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('adminViews.editProduct', compact('product', 'categories'));
    }

    public function updateProduct($id)
    {
        request()->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'category' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $product = Product::findOrFail($id);

        // Handle image upload if present
        if (request()->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = request()->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => request('name'),
            'description' => request('description'),
            'price' => request('price'),
            'quantity' => request('quantity'),
            'discount' => request('discount') ?? 0,
            'category_id' => request('category'),
            'image' => $product->image,
        ]);

        return redirect()->route('product.list')->with('success', 'Product updated successfully');
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        // Optionally delete the image from storage if needed
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('product.list')->with('success', 'Product deleted successfully');
    }
}
