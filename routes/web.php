<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RegisterController as AdminRegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\Usercontroller;
use App\Http\Controllers\User\HomeController;
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

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AdminRegisterController::class, 'register']);



Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resources(['dashboard' => DashboardController::class]);
    Route::resources(['category' => CategoryController::class]);
    Route::resources(['supplier' => SupplierController::class]);
    Route::resources(['product' => ProductController::class]);
    Route::get('/changeStatus', [ProductController::class, 'changeStatus'])->name('changeStatus');
    Route::resources(['user' => Usercontroller::class]);
    Route::resources(['order' => OrderController::class]);
});

Route::resources(['home' => HomeController::class]);
Route::get('admin2', function () {
    return view('admin.layouts.app');
});
