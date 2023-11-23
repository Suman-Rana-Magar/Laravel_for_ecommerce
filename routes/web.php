<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductIndexController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Providers\AuthServiceProvider;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


#all accessible |------------------------------------------------------------------------------------------------------------

#users

Route::post('/users/check', [UserController::class, 'check'])->name('users.check');

Route::post('/users', [UserController::class, 'store'])->name('users.store');


//products

Route::get("/products", [ProductController::class, 'index'])->name('products.index');

Route::get('/', [ProductController::class, 'index']);

Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/search', [ProductController::class, 'search'])->name('products.search');

Route::get('/products/searchByCategory/{catId}', [ProductController::class, 'searchByCategory'])->name('products.searchByCategory');

//carts

Route::get('/carts', [CartController::class, 'index'])->name('carts.index');


#only authenticated user accessible |----------------------------------------------------------------------------------------

Route::middleware(['auth'])->group(function () {

    #users

    Route::get('/users/info', [UserController::class, 'show'])->name('users.show');

    Route::get('/users/logout', [UserController::class, 'logout'])->name('users.logout');

    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

    Route::get('/users/edit-password', [UserController::class, 'changePassword'])->name('users.changePassword');

    Route::post('/users/{id}-changePassword', [UserController::class, 'updatePassword'])->name('users.updatePassword');

    Route::post('/users/{id}', [UserController::class, 'update'])->name('users.update');

    Route::get('/users/cancel/editing', [UserController::class, 'cancel'])->name('users.cancel');

    #carts

    Route::post('/carts/{id}', [CartController::class, 'store'])->name('carts.store');

    Route::get('carts/{id}/destroy', [CartController::class, 'destroy'])->name('carts.destroy');

    //orders

    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');

    Route::get('/orders/cancel/placing', [OrderController::class, 'cancel'])->name('orders.cancel');

    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});


//only admin accessible |--------------------------------------------------------------------------------------------------------

Route::middleware(['isAdmin'])->group(function () {
    //admin

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');

    Route::get('/admin/customers', [AdminController::class, 'customers'])->name('admin.customers');

    Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');

    Route::get('/adminn/{id}', [AdminController::class, 'switchToAdmin'])->name('admin.switchToAdmin');

    Route::get('/admin/{id}', [AdminController::class, 'switchToCustomer'])->name('admin.switchToCustomer');

    Route::get('/admin/me/profile', [AdminController::class, 'profile'])->name('admin.profile');

    Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');

    Route::post('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');

    Route::get('/admin/cancel/editing', [AdminController::class, 'cancel'])->name('admin.cancel');

    Route::get('/users/edit/password', [AdminController::class, 'changePassword'])->name('admin.changePassword');

    Route::post('/users/{id}/changePassword', [AdminController::class, 'updatePassword'])->name('admin.updatePassword');

    #products

    Route::get("/create/products", [ProductController::class, "create"])->name('products.create');

    Route::post("/products", [ProductController::class, 'store'])->name('products.store');

    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

    Route::post('/products/{id}', [ProductController::class, 'update'])->name('products.update');

    Route::get('/products/{id}/destroy-product', [ProductController::class, 'destroy'])->name('products.destroy');

    //categories

    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');

    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

    Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

    Route::post('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

    Route::get('/categories/{id}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');

    //Stocks

    Route::get('/stocks/index', [StockController::class, 'index'])->name('stocks.index');

    Route::get('/stocks/{id}', [StockController::class, 'show'])->name('stocks.show');
});


//only guest accessible |-------------------------------------------------------------------------------------------------------


Route::middleware(['guest'])->group(function () {

    Route::get('/register', [UserController::class, 'create'])->name('users.create');

    Route::get('/login', [UserController::class, 'index'])->name('users.index');

    Route::get('/enter-email', [UserController::class, 'forgot_password'])->name('users.forgot_password');

    Route::post('/check-email', [UserController::class, 'check_email'])->name('users.check-email');

    Route::get('/enter-token', [UserController::class,'enter_token'])->name('users.enter-token');

    Route::post('/check-token', [UserController::class, 'check_token'])->name('users.check-token');

    Route::get('/enter-password/change-password', [UserController::class,'enter_password'])->name('users.enter-password');

    Route::post('/reset-password/change-password', [UserController::class, 'reset_password'])->name('users.reset-password');
});

Route::get('/admin/reviews/customer-review', [AdminController::class, 'review'])->name('admin.review');

Route::get('/orders/detail/{id}', [OrderController::class, 'detail'])->name('orders.detail');


//review

Route::get('/reviews/create/{p_id}', [ReviewController::class, 'create'])->name('reviews.create');

Route::get('/reviews/cancel-reviewing/', [ReviewController::class, 'cancel'])->name('reviews.cancel');

Route::post('/reviews/{p_id}', [ReviewController::class, 'store'])->name('reviews.store');

Route::get('/reviews/allow/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');

Route::get('/reviews/deny/{id}/reviews', [ReviewController::class, 'destroy'])->name('reviews.destroy');

Route::get('/verify-email', [VerificationController::class, 'show'])->name('verification.notice');

Route::get('/verity-email/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');

Route::get('/verify-email/resend/{id}', [VerificationController::class, 'resend'])->name('verification.resend');

Route::get('/orders/deliver-order/{id}', [OrderController::class, 'deliver'])->name('orders.deliver');
