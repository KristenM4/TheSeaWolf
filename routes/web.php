<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\ProductController;

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

// Homepage Routes
Route::get('/', [HomeController::class, "homepage"])->name('login');

// User Accounts
Route::post('/login/', [AccountsController::class, "login"])->middleware('guest');
Route::get('/logout/', [AccountsController::class, "logout"])->middleware('isLoggedIn');
Route::get('/user-profile/', [AccountsController::class, "userProfile"])->middleware('isLoggedIn');
Route::get('/signup/', [AccountsController::class, "signup"])->middleware('guest');
Route::post('/signup-success/', [AccountsController::class, "signupSuccess"])->middleware('guest');

// Products
Route::get('/product/{product}/', [ProductController::class, "productPage"]);

// Products CRUD (admins only)
Route::get('/create-product/', [ProductController::class, "createProductForm"])->middleware('isStaff');
Route::post('/create-product/', [ProductController::class, "createProduct"])->middleware('isStaff');
Route::get('/manage-products/', [ProductController::class, "manageProducts"])->middleware('isStaff');
Route::get('/change-product-image/{product}/', [ProductController::class, "changeProductImage"])->middleware('isStaff');
Route::post('/change-product-image/{product}/', [ProductController::class, "saveNewProductImage"])->middleware('isStaff');
Route::get('/edit-product/{product}/', [ProductController::class, "editProductDetails"])->middleware('isStaff');
Route::post('/edit-product/', [ProductController::class, "saveNewDetails"])->middleware('isStaff');
Route::get('/delete-product/{product}/', [ProductController::class, "deleteProduct"])->middleware('isStaff');