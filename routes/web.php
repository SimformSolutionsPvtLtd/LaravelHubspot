<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
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
    return redirect('/login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    //LIST OF HUBSPOT USER
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    //UPDATE USER ROUTE
    Route::get('/update-user', [UserController::class, 'updateUser'])->name('update.user');
    //SAVE UPDATE USER
    Route::post('/save-update-user', [UserController::class, 'saveUpdateUser'])->name('save.user');
    //DELETE USER
    Route::get('/delete-user/{id}', [UserController::class, 'deleteUser']);
    //HUBSPOT USERS 
    Route::get('/hubspot-user', [UserController::class, 'userList'])->name('hubspot.user');
    //HUBSPOT CUSTOM OBJECT PRODUCT 
    Route::get('/create-product', [ProductController::class, 'createProduct'])->name('create.product');
    //SIGNUP NEWS LETTER
    Route::get('/signup-news', [UserController::class, 'signupUser'])->name('signup.user');
});
