<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('admin.authentication.login');
})->name('admin#loginpage');

Route::get('/login', function () {
    return view('admin.authentication.login');
})->name('login');

Route::get('/register', function () {
    return view('admin.authentication.register');
})->name('register');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard',[AdminController::class,'dashboardPage'])->name('dashboard');

    // profile
    Route::group(['prefix'=>'profile'],function(){

        Route::get('/edit',[ProfileController::class,'editProfilePage'])->name('admin#editprofilepage');
        Route::post('/edit',[ProfileController::class,'editProfile'])->name('admin#editprofile');

        // change password
        Route::get('/change/password',[ProfileController::class,'changePasswordPage'])->name('admin#changepasswordpage');
        Route::post('change/password',[ProfileController::class,'changePassword'])->name('admin#changepassword');

    });

});
