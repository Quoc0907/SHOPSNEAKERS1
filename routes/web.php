<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

// =========================
// Trang người dùng
// =========================
Route::get('/', [HomeController::class, 'index'])->name('home.index');

// =========================
// Trang sản phẩm
// =========================
Route::get('/shop', [ProductController::class, 'index'])->name('shop.index');
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/detail/{product}', [ProductController::class, 'detail'])->name('product.detail');

// =========================
// Search
// =========================
Route::get('/search', [ProductController::class, 'search'])->name('product.search');
Route::get('/search-ajax', [ProductController::class, 'searchAjax'])->name('product.search.ajax');
Route::get('/search-suggest', [ProductController::class, 'searchAjax'])->name('product.search.suggest');


// =========================
// Giỏ hàng
// =========================
Route::prefix('cart')->group(function () {

    Route::get('/', [CartController::class, 'index'])->name('cart.index');        // xem giỏ hàng
    Route::post('add', [CartController::class, 'add'])->name('cart.add');          // thêm vào giỏ
    Route::post('add-to-checkout', [CartController::class, 'addToCheckout'])->name('cart.addToCheckout'); // add + checkout
    Route::post('update', [CartController::class, 'update'])->name('cart.update'); // cập nhật số lượng
    Route::get('delete/{id}', [CartController::class, 'delete'])->name('cart.delete'); // xóa 1 sản phẩm
});

// order page
Route::group(["prefix" => "order"], function (){
    Route::get("/", [OrderController::class, "index"])->name("order.index");
    Route::get("verify_token/{token}", [OrderController::class, "verify"])->name("order.verify_token");
});


// =========================    
// Thanh toán
// =========================
Route::match(['get','post'], '/payment', [CartController::class, 'pay'])->name('payment.index');
Route::get('/order-success', function () {
    return view('order.success');
})->name('order.success');


// =========================
// Đăng nhập / Đăng ký khách hàng
// =========================
Route::get('/login', [CustomerController::class, 'showLoginForm'])->name('login');
Route::post('/login', [CustomerController::class, 'login']);
Route::get('/register', [CustomerController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [CustomerController::class, 'register']);
Route::post('/logout', [CustomerController::class, 'logout'])->name('logout');



// =========================
// Admin 
// =========================
Route::get('admin/login', [AdminHomeController::class, 'login'])->name('admin.login');
Route::post('admin/login', [AdminHomeController::class, 'login']);

// Route::get('admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
// Route::post('admin/login', [AuthController::class, 'login']);

Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('admin.home.index');

    // Product admin
    Route::get('product', [AdminProductController::class, 'index'])->name('admin.product.index');
    Route::get('product/edit/{product?}', [AdminProductController::class, 'edit'])->name('admin.product.edit');
    Route::post('product/edit', [AdminProductController::class, 'edit']);
    Route::get('product/delete/{product}', [AdminProductController::class, 'delete']);
     
    // Category admin — cần thêm
    Route::get('category', [AdminCategoryController::class, 'index'])->name('admin.category.index');
    Route::get('category/edit/{category?}', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('category/edit', [AdminCategoryController::class, 'edit']);
    Route::get('category/delete/{category}', [AdminCategoryController::class, 'delete'])->name('admin.category.delete');

    // ✅ Route đổi mật khẩu admin
    Route::get('change-password', [AuthController::class, 'showChangePasswordForm'])->name('admin.changePasswordForm');
    Route::post('change-password', [AuthController::class, 'changePassword'])->name('admin.changePassword');

});
