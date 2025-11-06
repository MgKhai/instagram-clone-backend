<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\PostController;
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


    // Route::resource('users', UserController::class, ['only' => ['index', 'store', 'update', 'show']]);

    // Route::resource('tenants', TenantController::class, ['only' => ['index', 'store', 'update', 'show']]);

    // Route::resource('occupants',OccupantController::class,['only'=> ['index','store','update','show']]);

    // Route::resource('rooms', RoomController::class, ['only' => ['index','store','update','show']]);

    // Route::resource('contracts', ContractController::class, ['only' => ['index', 'store', 'update', 'show']]);

    // Route::resource('contract-types', ContractTypeController::class, ['only' => ['index', 'store', 'update', 'show']]);

    // Route::resource('bills', BillController::class, ['only' => ['index', 'store', 'show']]);

    // Route::resource('total-units', TotalUnitController::class, ['only' => ['index', 'show']]);

    // Route::apiResource('invoices', InvoiceController::class)->only(['index','store', 'show', 'update']);

    // Route::resource('customer-services', CustomerServiceController::class, ['only' => ['index', 'update', 'show']]);

    // Route::resource('receipts', ReceiptController::class, ['only' => ['index','store','update','show']]);
});
