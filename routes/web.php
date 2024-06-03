<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/',[UserController::class,'homeUser'])->name('homeUser');

Route::get('/katalog',[UserController::class,'katalog'])->name('katalog');
Route::get('/getProduct',[UserController::class,'getProduct'])->name('getProduct');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/login',[AuthController::class,'loginPost'])->name('loginPost');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/register',[AuthController::class,'registerPost'])->name('regsiterPost');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::post('/pemesanan/store',[PemesananController::class,'store'])->name('pemesanan.store');
Route::get('/transaksi',[PemesananController::class,'transaksi'])->name('transaksi');

Route::post('/cartPost',[CartController::class,'store'])->name('cart.store');
Route::get('/cart/{id}',[CartController::class,'index'])->name('cart.index');

Route::get('/kategori',[KategoriController::class,'index'])->name('kategori.index');
Route::get('/kategori/create',[KategoriController::class,'create'])->name('kategori.create');
Route::post('/kategori/store',[KategoriController::class,'store'])->name('kategori.store');
Route::get('/kategori/edit/{id}',[KategoriController::class,'edit'])->name('kategori.edit');
Route::post('/kategori/update/{id}',[KategoriController::class,'update'])->name('kategori.update');
Route::get('/kategori/delete/{id}',[KategoriController::class,'delete'])->name('kategori.delete');

Route::get('/products',[ProductController::class,'index'])->name('product.index');
Route::get('/products/create',[ProductController::class,'create'])->name('product.create');
Route::post('/products/store',[ProductController::class,'store'])->name('product.store');
Route::get('/products/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
Route::put('/products/update/{id}',[ProductController::class,'update'])->name('product.update');
Route::delete('/products/delete/{id}',[ProductController::class,'delete'])->name('product.delete');


/* ============= Payment ============= */
Route::get('/payments',[PaymentController::class,'index'])->name('payment.index');
Route::get('/payments/create',[PaymentController::class,'create'])->name('payment.create');
Route::post('/payments/store',[PaymentController::class,'store'])->name('payment.store');
Route::get('/payments/edit/{id}',[PaymentController::class,'edit'])->name('payment.edit');
Route::put('/payments/update/{id}',[PaymentController::class,'update'])->name('payment.update');
Route::delete('/payments/delete/{id}',[PaymentController::class,'delete'])->name('payment.delete');

