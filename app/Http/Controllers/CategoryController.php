<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return response([
            'categories' => $categories,
            'status' => 'success',
        ]);
    }

    public function fetchProductsUnderCategory($id)
    {
        $products = Product::with('category')->where('category_id',$id)->latest()->get();
        if(empty($products)) {
            return response([
                'status' => 'error',
                'message' => 'Category not found',
            ],404);
        }

        return response([
            'products' => $products,
            'status' => 'success',
        ]);
    }
}
