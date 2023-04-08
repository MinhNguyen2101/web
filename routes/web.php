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
use App\Http\Controllers\User\HomepageController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\User\ProfileController;
use App\Models\CartProduct;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

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
    Route::get('changeStatusOrder', [OrderController::class, 'changeStatus'])->name('changeStatusOrder');
    Route::get('order-process', [OrderController::class, 'orderProcess'])->name('order-process');
    Route::get('order-success', [OrderController::class, 'orderSuccess'])->name('order-success');
    Route::get('order-cancel', [OrderController::class, 'orderCancel'])->name('order-cancel');
    Route::post('quan', [ProfileController::class, 'loadQuan'])->name('loadQuan');
    Route::post('xa', [ProfileController::class, 'loadXa'])->name('loadXa');
});

// Route::resources(['home' => HomeController::class]);
// Route::get('admin2', function () {
//     return view('user.homepage');
// });

// Route::get('homepage', [HomepageController::class, 'index'])->name('trang-chu');
Route::resources(['product' => UserProductController::class]);
Route::post('product',[UserProductController::class,'index'])->name('route-index');
Route::get('/cart', [UserProductController::class, 'cartProduct'])->name('cartProduct');
Route::post('/addtocard', [UserProductController::class, 'addToCard'])->name('add-to-card');
Route::post('/updateQuantity', [UserProductController::class, 'updateQuantityCart'])->name('update-quantity');
Route::post('/deleteProduct', [UserProductController::class, 'deleteProduct'])->name('deleteProduct');
Route::resources(['profile' => ProfileController::class]);
Route::get('order_history', [ProfileController::class, 'orderHistory'])->name('order-history');
Route::get('change-pass', [ProfileController::class, 'showChangePass'])->name('showChangePass');
Route::post('change-pass', [ProfileController::class, 'changePass'])->name('change-pass');
Route::get('checkout', [ProfileController::class, 'checkout'])->name('checkout');
Route::post('check-out', [UserProductController::class, 'orderCheckout'])->name('order');
Route::get('trang_chu', [HomepageController::class,'index'])->name('trang-chu');
Route::post('search-product',[HomepageController::class,'searchProduct'])->name('search-product');
// Route::get('product', function () {
//     return view('user.product');
// });
