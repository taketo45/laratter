<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// 🔽 追加
use App\Http\Controllers\Api\AuthController;

// 🔽 追加
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
