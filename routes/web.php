<?php

use Illuminate\Support\Facades\Route;//route chính 
use App\Http\Controllers\HomeController;//trang home chính 
use App\Http\Controllers\Admin\HomeController as AdminHomeController;//trang home admin chính
use App\Http\Controllers\CustomerController;//trang quảm lý 
use App\Http\Controllers\Admin\ProductController as AdminProductController;//trang sp admin 
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;//dánh giá số sao 
use App\Http\Controllers\Admin\AuthController; // ✅ Dùng AuthController
use App\Http\Middleware\EmployeeMiddleWare;
use App\Http\Controllers\CartController;//thêm sp vào giỏ hàng
// use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =========================
// Trang người dùng
// =========================
Route::get("/", [HomeController::class, "index"])->name("home.index");
// Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get("product", [ProductController::class, "index"])->name("product.index");
Route::get("product/detail/{product}", [ProductController::class, "detail"])->name("product.detail");

// =========================
// Trang Admin
// =========================

// 🔐 Đăng nhập admin
Route::get("admin/login", [AdminHomeController::class, "login"])->name("admin.login");
Route::post("admin/login", [AdminHomeController::class, "login"]);
// Route::get("admin/login", [AuthController::class, "showLoginForm"])->name("admin.login");
// Route::post("admin/login", [AuthController::class, "login"]);

Route::post("admin/logout", [AuthController::class, "logout"])->name("admin.logout");

// ✅ Các route bên trong admin (phải đăng nhập)
Route::prefix("admin")->middleware("auth:admin")->group(function () {

    Route::get("/", [AdminHomeController::class, "index"])->name("admin.home.index");

    // Product
    Route::get("product", [AdminProductController::class, "index"])->name("admin.product.index");
    Route::get("product/edit/{product?}", [AdminProductController::class, "edit"])->name("admin.product.edit");
    Route::post("product/edit", [AdminProductController::class, "edit"]);
    Route::get("product/delete/{product}", [AdminProductController::class, "delete"]);
    // Route::get('/product-detail/{id}', [ProductController::class, 'show'])->name('product.detail');
    Route::get('/product/{id}', [ProductController::class, 'detail'])->name('product.detail');
    
    // Category
    Route::get("category", [AdminCategoryController::class, "index"])->name("admin.category.index");
    Route::get("category/edit/{category?}", [AdminCategoryController::class, "edit"])->name("admin.category.edit");
    Route::post("category/edit", [AdminCategoryController::class, "edit"]);
    Route::get("category/delete/{category}", [AdminCategoryController::class, "delete"]);

    // ✅ Đổi mật khẩu admin
    Route::get("change-password", [AuthController::class, "showChangePasswordForm"])->name("admin.changePasswordForm");
    Route::post("change-password", [AuthController::class, "changePassword"])->name("admin.changePassword");
    // Route::get("admin/login", [AuthController::class, "showLoginForm"])->name("admin.login");
    // Route::post("admin/login", [AuthController::class, "login"]);

    
});

// =========================
// Review
// =========================
Route::post('/review/{productId}', [ReviewController::class, 'store'])->middleware('auth');

// =========================
// Khách hàng: login / register / logout
// =========================
Route::get('/login', [CustomerController::class, 'showLoginForm'])->name('login');
Route::post('/login', [CustomerController::class, 'login']);
Route::get('/register', [CustomerController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [CustomerController::class, 'register']);
Route::post('/logout', [CustomerController::class, 'logout'])->name('logout');

// =========================
// Checkout (chỉ khi user đã đăng nhập)
// =========================
Route::middleware('auth')->group(function () {
    Route::get('/checkout', function () {
        return view('checkout');
    })->name('checkout');
});
// Route::post('/logout', function() {
//     Auth::logout();
//     return redirect('/');
// })->name('logout');

// =========================
// trang giỏ hàng
// =========================
Route::group(["prefix" => "cart"], function(){
    Route::get("/", [CartController::class, "index"])->name("cart.index");
    Route::get("add/{product}", [CartController::class, "add"]);
    Route::post("add/{product}", [CartController::class, "add"])->name("cart.add");
    Route::get("cart/add/{product}", [CartController::class, "add"])->name("cart.add");

    Route::post("update", [CartController::class, "update"])->name("cart.update");
    Route::get("remove/{product}", [CartController::class, "remove"])->name("cart.remove");
    Route::get("clear", [CartController::class, "clear"])->name("cart.clear");


});
// =========================
// Route search cho khách hàng
// =========================

// Route::get('/search', [ProductController::class, 'search'])->name('product.search');
Route::get('/search', [ProductController::class, 'search'])->name('product.search');
Route::get('/search-ajax', [ProductController::class, 'searchAjax'])->name('product.search.ajax');
Route::get('/search-suggest', [ProductController::class, 'searchAjax'])->name('product.search.suggest');

