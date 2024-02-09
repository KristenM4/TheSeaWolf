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
Route::get('/user-profile/{user}/', [AccountsController::class, "userProfile"])->middleware('isLoggedIn');
Route::get('/signup/', [AccountsController::class, "signup"])->middleware('guest');
Route::post('/signup-success/', [AccountsController::class, "signupSuccess"])->middleware('guest');

// Products
Route::get('/product/{product}/', [ProductController::class, "productPage"]);

// Products CRUD (admins only)
Route::get('/create-product/', [ProductController::class, "createProductForm"])->middleware('isLoggedIn');
Route::post('/create-product/', [ProductController::class, "createProduct"])->middleware('isLoggedIn');
Route::get('/manage-products/', [ProductController::class, "manageProducts"])->middleware('isLoggedIn');
Route::get('/change-product-image/{product}/', [ProductController::class, "changeProductImage"])->middleware('isLoggedIn');
Route::post('/change-product-image/{product}/', [ProductController::class, "saveNewProductImage"])->middleware('isLoggedIn');
Route::get('/edit-product/{product}/', [ProductController::class, "editProductDetails"])->middleware('isLoggedIn');
Route::post('/edit-product/', [ProductController::class, "saveNewDetails"])->middleware('isLoggedIn');
Route::get('/delete-product/{product}/', [ProductController::class, "deleteProduct"])->middleware('isLoggedIn');