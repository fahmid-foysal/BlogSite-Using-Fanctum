<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('signup',[AuthController::class,'signup']);
Route::post('login',[AuthController::class,'login']);
Route::post('logout',[AuthController::class,'logout'])->middleware('auth:sanctum');

Route::apiResource('posts',PostController::Class)->middleware('auth:sanctum');
Route::apiResource('user',UserController::Class)->middleware('auth:sanctum');
Route::get('user/{email}', [UserController::class, 'show'])->middleware('auth:sanctum');


