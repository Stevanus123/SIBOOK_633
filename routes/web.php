<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::fallback([MainController::class, 'not_found']);


Route::middleware('guest')->group(function () {
    Route::get('/', [MainController::class, 'login'])->name('login');
    Route::get('/regis', [MainController::class, 'regis']);
    Route::post('/prosesRegis', [MainController::class, 'prosesRegis']);
    Route::post('/ceklogin', [MainController::class, 'ceklogin']);
});


Route::middleware('auth')->group(function () {
    // user
    Route::get('/home', [MainController::class, 'home']);
    Route::get('/promo', [MainController::class, 'promo']);
    Route::get('/kategori/{jenis}', [MainController::class, 'kategori']);
    
    // profile
    Route::get('/profile', [MainController::class, 'profile']);
    Route::get('/profile/edit', [MainController::class, 'edit_profile']);
    Route::get('/profile/topup', [MainController::class, 'topup_profile']);
    Route::post('/topup/request', [MainController::class, 'req_topup']);
    
    // search
    Route::get('/{asal}/search', [MainController::class, 'search']);
    
    // cart
    Route::get('/cart', [MainController::class, 'cart']);
    Route::get('/cart/insert/{id}', [MainController::class, 'insert_cart']);
    Route::get('/cart/{act}/{id}', [MainController::class, 'cart_p_m']);
    
    // order
    Route::post('/checkout', [MainController::class, 'checkout']);
    Route::post('/order', [MainController::class, 'order']);

    // detail
    Route::get('/{asal}/buku/{slug}', [MainController::class, 'detail_buku']);
    
    // penerbitan
    Route::get('/penerbitan', [MainController::class, 'penerbitan']);
    Route::get('/terbit/insert', [MainController::class, 'insert_terbit']);
    Route::post('/terbit/store', [MainController::class, 'store_terbit']);


    // admin prefix
    Route::prefix('admin')->group(function () {
        Route::get('/buku', [MainController::class, 'admin_buku']);
        Route::get('/kategori', [MainController::class, 'admin_kategori']);
        Route::get('/diskon', [MainController::class, 'admin_diskon']);
        Route::get('/user', [MainController::class, 'admin_user']);
        Route::get('/terbit', [MainController::class, 'admin_terbit']);
        Route::get('/saldo', [MainController::class, 'admin_saldo']);
        Route::post('/saldo/{act}/{id}', [MainController::class, 'act_saldo']);
        
        // detail
        Route::get('/terbit/detail/{id}', [MainController::class, 'detail_terbit']);

        // insert
        Route::get('/buku/insert', [MainController::class, 'insert_buku']);
        Route::get('/kategori/insert', [MainController::class, 'insert_kategori']);
        Route::get('/diskon/insert', [MainController::class, 'insert_diskon']);
        Route::get('/user/insert', [MainController::class, 'insert_user']);

        Route::post('/buku/store', [MainController::class, 'store_buku']);
        Route::post('/kategori/store', [MainController::class, 'store_kategori']);
        Route::post('/diskon/store', [MainController::class, 'store_diskon']);
        Route::post('/user/store', [MainController::class, 'store_user']); 

        // update
        Route::get('/buku/edit/{id}', [MainController::class, 'edit_buku']);
        Route::get('/kategori/edit/{id}', [MainController::class, 'edit_kategori']);
        Route::get('/diskon/edit/{id}', [MainController::class, 'edit_diskon']);

        Route::put('/buku/update/{id}', [MainController::class, 'update_buku']);
        Route::put('/kategori/update/{id}', [MainController::class, 'update_kategori']);
        Route::put('/diskon/update/{id}', [MainController::class, 'update_diskon']);

        // delete
        Route::get('/buku/delete/{id}', [MainController::class, 'delete_buku']);
        Route::get('/kategori/delete/{id}', [MainController::class, 'delete_kategori']);
        Route::get('/diskon/delete/{id}', [MainController::class, 'delete_diskon']);
        Route::get('/user/delete/{id}', [MainController::class, 'delete_user']);
    });

    Route::get('/logout', [MainController::class, 'logout']);
});

