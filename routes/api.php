<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class,'index'])
    ->middleware('auth:sanctum');
Route::get('/product/{id}', [ProductController::class,'viewProduct'])
    ->middleware('auth:sanctum');
Route::get('/categories', [CategoryController::class,'index'])
    ->middleware('auth:sanctum');
Route::get('/categories/product/{id}', [ProductController::class,'fetchProductsUnderCategory'])
    ->middleware('auth:sanctum');
Route::get('/favorites', [FavoriteController::class,'index'])
    ->middleware('auth:sanctum');
Route::post('/favorites', [FavoriteController::class,'addToFavorites'])
    ->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
