<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//Posts
Route::get('/posts', [PostController::class, 'index']);
//Route::apiResource('posts', PostController::class);

Route::post('posts', [PostController::class, 'store']);

Route::get('/posts/{id}', [PostController::class, 'show']);

Route::put('/posts/{id}', [PostController::class, 'update']);

Route::delete('/posts/{id}', [PostController::class, 'destroy']);

//Comment
Route::post('/posts/{post_id}/comments', [CommentController::class, 'store']);

Route::put('/posts/{post_id}/comments/{id}', [CommentController::class, 'update']);

Route::delete('posts/{post_id}/comments/{id}', [CommentController::class, 'destroy']);