<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class ClientController extends Controller
{
    public function viewClient()
    {   $products = Product::all();
        return view('clientViews.client', compact('products'));
    }
}
