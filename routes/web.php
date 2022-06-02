<?php

use Illuminate\Support\Facades\Route;
use App\Models\ShopProduct;
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

// Route::get('/', function () {
//     return view('welcome', ['pageTitle' => 'Shop Products | Home']);
// });

Route::get('/', [App\Http\Controllers\ShopProductController::class, 'index'])->name('shopProduct.index');
Route::get('/products/create', [App\Http\Controllers\ShopProductController::class, 'create'])->name('shopProduct.create')->middleware('auth');
Route::get('/products/{shopProduct}', [App\Http\Controllers\ShopProductController::class, 'show'])->name('shopProduct.show');

Route::post('/products', [App\Http\Controllers\ShopProductController::class, 'store'])->name('shopProduct.store')->middleware('auth');
Route::get('/products/{shopProduct}/edit', [App\Http\Controllers\ShopProductController::class, 'edit'])->name('shopProduct.edit')->middleware('auth');
Route::patch('/products/{shopProduct}', [App\Http\Controllers\ShopProductController::class, 'update'])->name('shopProduct.update')->middleware('auth');
Route::delete('/products/{shopProduct}', [App\Http\Controllers\ShopProductController::class, 'destroy'])->name('shopProduct.destroy')->middleware('auth');

//Reset custom password
Route::post('reset_password_without_token', 'AccountsController@validatePasswordRequest');
Route::post('reset_password_with_token', 'AccountsController@resetPassword');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
