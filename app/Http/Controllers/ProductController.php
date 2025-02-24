<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return response([
            'products' => $products,
            'status' => 'success',
        ]);
    }

    public function viewProduct($id){
        $product = Product::with('category')->where('id',$id)->first();
        if(empty($product)) {
            return response([
                'status' => 'error',
                'message' => 'Product not found',
            ],404);
        }
        return response([
            'product' => $product,
            'status' => 'success',
        ]);
    }
}
