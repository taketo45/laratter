<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// 🔽 追加
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TweetController;
use App\Http\Controllers\Api\TweetLikeController;
use App\Http\Controllers\Api\CommentController;

// 🔽 追加
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tweets', TweetController::class);
    Route::post('/tweets/{tweet}/like', [TweetLikeController::class, 'store']);
    Route::delete('/tweets/{tweet}/like', [TweetLikeController::class, 'destroy']);
    Route::apiResource('tweets.comments', CommentController::class);
});