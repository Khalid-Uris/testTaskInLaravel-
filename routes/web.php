<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
});

Route::view('master','admin/master');



Route::get('user/login',[LoginController::class,'loginView'])->name('user.login');
Route::get('user/loginCheck',[LoginController::class,'login'])->name('user.loginCheck');

Route::get('user/logout',[LoginController::class,'logout'])->name('user.logout');

// Middleware use here
Route::middleware(['admin'])->group(function () {

Route::get('user/add',[UserController::class,'index'])->name('user.add');
Route::post('user/store',[UserController::class,'store'])->name('user.store');

Route::get('admin/showUser',[UserController::class,'show'])->name('admin.showUser');

Route::get('user/edit/{id}',[UserController::class,'edit'])->name('user.edit');
Route::post('user/update/{id}',[UserController::class,'update'])->name('user.update');
Route::get('user/destroy/{id}',[UserController::class,'destroy'])->name('user.destroy');
});
