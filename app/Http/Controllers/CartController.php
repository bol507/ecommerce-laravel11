<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
     public function addToCart($product_id){
        try{
            $check_cart= Cart::where('user_id',auth()->id())
                ->where('product_id',$product_id)
                ->first();
            if($chec_cart) {
                Cart::where('user_id',auth()->id())
                    ->where('product_id',$product_id)
                    ->delete();
                return response([
                    'status' => 'success',
                    'message' => 'Product removed from cart',
                ],  200);
            }
            $favorite = Cart::create([
                'user_id' => auth()
                    ->id(),
                'product_id' => $product_id,
            ]);
            return response([
                'status' => 'success',
                'message' => 'Product added to favorites',
            ],  200);
        }catch(Exception $e){
            return response([
                'status' => 'error',
                'message' => $e->getMessage(),
            ],  500);
        }
    }
}
