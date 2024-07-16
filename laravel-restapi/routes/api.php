<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
Route::get('/products/sort/name', [ProductController::class, 'sortByName']);
Route::get('/products/sort/price', [ProductController::class, 'sortByPrice']);
Route::get('/products/filter/category/{categoryId}', [ProductController::class, 'filterByCategory']);

Route::get('/categories', [CategoryController::class, 'index']);
