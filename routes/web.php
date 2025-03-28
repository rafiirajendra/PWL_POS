<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;

Route::pattern('id', '[0-9]+'); // ketika ada parameter {id}, maka harus berupa angka
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function(){ // semua route di dalam group ini harus login terlebih dulu
    // masukkan semua route yang perlu autentikasi di sini

    Route::get('/', [WelcomeController::class, 'index']);

    Route::middleware(['authorize:ADM'])->group(function() { // semua route di dalam group ini harus memiliki role admin
            Route::get('/level', [LevelController::class, 'index']);        // Menampilkan daftar level
            Route::post('/level/list', [LevelController::class, 'list']);    // Menampilkan data level dalam JSON untuk datatables
            Route::get('/level/create', [LevelController::class, 'create']); // Menampilkan form tambah level
            Route::post('/level', [LevelController::class, 'store']);       // Menyimpan level baru
            Route::get('/level/{id}', [LevelController::class, 'show']);     // Menampilkan detail level
            Route::get('/level/{id}/edit', [LevelController::class, 'edit']); // Menampilkan form edit level
            Route::put('/level/{id}', [LevelController::class, 'update']);   // Menyimpan perubahan data level
            Route::delete('/level/{id}', [LevelController::class, 'destroy']); // Menghapus level
        
    });

    Route::middleware(['authorize:ADM'])->group(function () {
        Route::get('/barang', [BarangController::class, 'index']);        // Menampilkan daftar Barang
        Route::post('/barang/list', [BarangController::class, 'list']);    // Menampilkan data Barang dalam JSON untuk datatables
        Route::get('/barang/create_ajax', [BarangController::class, 'create_ajax']); // Menampilkan halaman form tambah Barang Ajax
        Route::post('/barang/ajax', [BarangController::class, 'store_ajax']); // menyimpan data Barang baru Ajax
        Route::get('/barang/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // Menampilkan halaman form edit Barang Ajax
        Route::put('/barang/{id}/update_ajax', [BarangController::class, 'update_ajax']); // menyimpan perubahan data Barang Ajax
        Route::get('/barang/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // untuk tampilkan form confirm delete Barang Ajax
        Route::delete('/barang/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // untuk menghapus data Barang Ajax
    });

    // Route::group(['prefix' => 'user'], function () {
    //     Route::get('/', [UserController::class, 'index']);        // menampilkan halaman awal user
    //     Route::post('/list', [UserController::class, 'list']);    // menampilkan data user dalam bentuk json untuk datatables
    //     // Route::get('/create', [UserController::class, 'create']); // menampilkan halaman form tambah user
    //     // Route::post('/', [UserController::class, 'store']);       // menyimpan data user baru
    //     // Route::get('/{id}', [UserController::class, 'show']);     // menampilkan detail user
    //     // Route::get('/{id}/edit', [UserController::class, 'edit']); // menampilkan halaman form edit user
    //     // Route::put('/{id}', [UserController::class, 'update']);   // menyimpan perubahan data user
    //     // Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
    
    //     // ajax
    //     Route::get('/create_ajax', [UserController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
    //     Route::post('/ajax', [UserController::class, 'store_ajax']); // menyimpan data user baru Ajax
    //     Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // Menampilkan halaman form edit user Ajax
    //     Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // menyimpan perubahan data user Ajax
    //     Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // untuk tampilkan form confirm delete user Ajax
    //     Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // untuk menghapus data user Ajax
    // });
    
    // Route::group(['prefix' => 'level'], function () {
    //     Route::get('/', [LevelController::class, 'index']);        // Menampilkan daftar level
    //     Route::post('/list', [LevelController::class, 'list']);    // Menampilkan data level dalam JSON untuk datatables
    //     // Route::get('/create', [LevelController::class, 'create']); // Menampilkan form tambah level
    //     // Route::post('/', [LevelController::class, 'store']);       // Menyimpan level baru
    //     // Route::get('/{id}', [LevelController::class, 'show']);     // Menampilkan detail level
    //     // Route::get('/{id}/edit', [LevelController::class, 'edit']); // Menampilkan form edit level
    //     // Route::put('/{id}', [LevelController::class, 'update']);   // Menyimpan perubahan data level
    //     // Route::delete('/{id}', [LevelController::class, 'destroy']); // Menghapus level
    
    //     // ajax
    //     Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // Menampilkan halaman form tambah Level Ajax
    //     Route::post('/ajax', [LevelController::class, 'store_ajax']); // menyimpan data Level baru Ajax
    //     Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // Menampilkan halaman form edit Level Ajax
    //     Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // menyimpan perubahan data Level Ajax
    //     Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // untuk tampilkan form confirm delete Level Ajax
    //     Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // untuk menghapus data Level Ajax
    // });
    
    // Route::group(['prefix' => 'kategori'], function () {
    //     Route::get('/', [KategoriController::class, 'index']);        // Menampilkan daftar kategori
    //     Route::post('/list', [KategoriController::class, 'list']);    // Menampilkan data kategori dalam JSON untuk datatables
    //     // Route::get('/create', [KategoriController::class, 'create']); // Menampilkan form tambah kategori
    //     // Route::post('/', [KategoriController::class, 'store']);       // Menyimpan kategori baru
    //     // Route::get('/{id}', [KategoriController::class, 'show']);     // Menampilkan detail kategori
    //     // Route::get('/{id}/edit', [KategoriController::class, 'edit']); // Menampilkan form edit kategori
    //     // Route::put('/{id}', [KategoriController::class, 'update']);   // Menyimpan perubahan data kategori
    //     // Route::delete('/{id}', [KategoriController::class, 'destroy']); // Menghapus kategori
    
    //     // ajax
    //     Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); // Menampilkan halaman form tambah Kategori Ajax
    //     Route::post('/ajax', [KategoriController::class, 'store_ajax']); // menyimpan data Kategori baru Ajax
    //     Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); // Menampilkan halaman form edit Kategori Ajax
    //     Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // menyimpan perubahan data Kategori Ajax
    //     Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); // untuk tampilkan form confirm delete Kategori Ajax
    //     Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // untuk menghapus data Kategori Ajax
    // });
});