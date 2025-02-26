<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        try{
            $favorites = Favorite::with('product.category')
                ->where('user_id',auth()
                ->id())
                ->get();
            return response([
                'favorites' => $favorites,
                'status' => 'success',
            ]);
        }catch(Exception $e){
            return response([
                'status' => 'error',
                'message' => $e->getMessage(),
            ],  500);
        }
    }

    public function addToFavorites($product_id){
        try{
            $check_favorite = Favorite::where('user_id',auth()->id())
                ->where('product_id',$product_id)
                ->first();
            if($check_favorite) {
                Favorite::where('user_id',auth()->id())
                    ->where('product_id',$product_id)
                    ->delete();
                return response([
                    'status' => 'success',
                    'message' => 'Product removed from favorites',
                ],  200);
            }
            $favorite = Favorite::create([
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
