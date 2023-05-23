<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('/auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('registeruser',[App\Http\Controllers\Auth\RegisterController::class,'registeruser'])->name('reg');

Route::get('register',[App\Http\Controllers\Auth\RegisterController::class,'registerform'])->name('register');

Route::get('set-password',[App\Http\Controllers\Auth\RegisterController::class,'setpassword'])->name('setpassword');

Route::post('save_user',[App\Http\Controllers\Auth\RegisterController::class,'save_user'])->name('save_user');
