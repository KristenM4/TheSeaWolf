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
Route::get('/', [HomeController::class, "homepage"]);

// User Accounts
Route::post('/login/', [AccountsController::class, "login"]);
Route::get('/logout/', [AccountsController::class, "logout"]);
Route::get('/signup/', [AccountsController::class, "signup"]);
Route::post('/signup-success/', [AccountsController::class, "signupSuccess"]);

// Products
Route::get('/create-product/', [ProductController::class, "createProductForm"]);
