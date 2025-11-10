<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\FollowerController;
use App\Http\Controllers\Api\Auth\AuthController;

Route::post('/auth/login',[AuthController::class,'login']);
Route::post('/auth/register',[AuthController::class,'register']);

Route::middleware('auth:sanctum')->group(function ()
{
    // post route
    Route::get('/post', [PostController::class, 'index']);
    Route::post('/post',[PostController::class, 'store']);
    Route::get('/post/{id}',[PostController::class, 'destroy']);

    // like route
    Route::post('/post/like',[LikeController::class,'toggleLike']);

    // follower route
    Route::post('/follow',[FollowerController::class,'toggleFollow']);
    Route::get('/followers/{id}',[FollowerController::class,'followers']);
    Route::get('/following/{id}',[FollowerController::class,'following']);
    Route::get('/mutual/followers/{id}',[FollowerController::class,'mutualFollowers']);

    // comment
    Route::post('/comment',[CommentController::class,'store']);
    Route::get('/comment/{id}',[CommentController::class,'index']);

});
