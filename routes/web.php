<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DiskonController;
use App\Http\Controllers\Admin\SaldoController;
use App\Http\Controllers\Admin\TerbitController as AdminTerbitController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\TerbitController;
use Illuminate\Support\Facades\Route;

Route::fallback([ErrorController::class, 'not_found']);

Route::get('/search/{asal}', [MainController::class, 'search']);

Route::middleware('guest')->group(function () {
    Route::get('/', [HomeController::class, 'home']);
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/regis', [AuthController::class, 'regis']);
    Route::post('/prosesRegis', [AuthController::class, 'prosesRegis']);
    Route::post('/ceklogin', [AuthController::class, 'ceklogin']);
});


Route::middleware('auth')->group(function () {
    // admin prefix
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard']);

        Route::get('/buku', [BookController::class, 'admin_buku']);
        Route::get('/buku/insert', [BookController::class, 'insert_buku']);
        Route::post('/buku/store', [BookController::class, 'store_buku']);
        Route::get('/buku/edit/{id}', [BookController::class, 'edit_buku']);
        Route::put('/buku/update/{id}', [BookController::class, 'update_buku']);
        Route::get('/buku/delete/{id}', [BookController::class, 'delete_buku']);

        Route::get('/kategori', [CategoryController::class, 'admin_kategori']);
        Route::get('/kategori/insert', [CategoryController::class, 'insert_kategori']);
        Route::post('/kategori/store', [CategoryController::class, 'store_kategori']);
        Route::get('/kategori/edit/{id}', [CategoryController::class, 'edit_kategori']);
        Route::put('/kategori/update/{id}', [CategoryController::class, 'update_kategori']);
        Route::get('/kategori/delete/{id}', [CategoryController::class, 'delete_kategori']);

        Route::get('/diskon', [DiskonController::class, 'admin_diskon']);
        Route::get('/diskon/insert', [DiskonController::class, 'insert_diskon']);
        Route::get('/diskon/edit/{id}', [DiskonController::class, 'edit_diskon']);
        Route::post('/diskon/store', [DiskonController::class, 'store_diskon']);
        Route::put('/diskon/update/{id}', [DiskonController::class, 'update_diskon']);
        Route::get('/diskon/delete/{id}', [DiskonController::class, 'delete_diskon']);

        Route::get('/user', [UserController::class, 'admin_user']);
        Route::get('/user/insert', [UserController::class, 'insert_user']);
        Route::post('/user/store', [UserController::class, 'store_user']);
        Route::get('/user/edit/{id}', [UserController::class, 'edit_user']);
        Route::get('/user/delete/{id}', [UserController::class, 'delete_user']);

        Route::get('/terbit', [AdminTerbitController::class, 'admin_terbit']);
        Route::get('/terbit/detail/{id}', [AdminTerbitController::class, 'detail_terbit']);
        Route::get('/terbit/setuju/{id}', [AdminTerbitController::class, 'setuju_terbit']);
        Route::post('/terbit/tolak/{id}', [AdminTerbitController::class, 'tolak_terbit']);

        Route::get('/saldo', [SaldoController::class, 'admin_saldo']);
        Route::get('/saldo-detail', [SaldoController::class, 'detail_saldo']);
        Route::post('/saldo/{act}/{id}', [SaldoController::class, 'act_saldo']);
    });

    // user
    Route::get('/home', [HomeController::class, 'home']);
    
    // promo
    Route::get('/promo', [PromoController::class, 'promo']);
    Route::get('/promo/{id}', [PromoController::class, 'detail_promo']);
    
    // profile
    Route::get('/profile', [ProfileController::class, 'profile']);
    Route::get('/profile/baca/{judul}', [ProfileController::class, 'baca_profile']);
    Route::get('/profile/terbit/{id}', [ProfileController::class, 'terbit_profile']);
    Route::post('/profile/topup', [ProfileController::class, 'topup_profile']);
    Route::post('/profile/edit', [ProfileController::class, 'edit_profile']);
    Route::post('/profile/gantiPass', [ProfileController::class, 'gantiPass_profile']);
    Route::post('/profile/check-password', [ProfileController::class, 'checkPassword']);

    //kategori
    Route::get('/kategori/{jenis}', [KategoriController::class, 'kategori']);

    // cart
    Route::get('/cart', [CartController::class, 'cart']);
    Route::get('/cart/insert/{id}', [CartController::class, 'insert_cart']);
    Route::get('/cart/{act}/{id}', [CartController::class, 'cart_p_m']);

    // order
    Route::post('/checkout', [CartController::class, 'checkout']);
    Route::post('/order', [CartController::class, 'order']);

    // penerbitan
    Route::get('/penerbitan', [TerbitController::class, 'penerbitan']);
    Route::get('/terbit/insert', [TerbitController::class, 'insert_terbit']);
    Route::post('/terbit/store', [TerbitController::class, 'store_terbit']);
    Route::get('/terbit/edit/{id}', [TerbitController::class, 'edit_terbit']);
    Route::put('/terbit/update/{id}', [TerbitController::class, 'update_terbit']);
    Route::get('/terbit/delete/{id}', [TerbitController::class, 'delete_terbit']);
    
    // detail-buku
    Route::get('/detail/{asal}/buku/{slug}', [MainController::class, 'detail_buku']);

    Route::get('/logout', [AuthController::class, 'logout']);
});
