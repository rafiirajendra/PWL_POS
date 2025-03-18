<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [WelcomeController::class, 'index']);

// Route::get('/level',[LevelController::class,'index']);
// Route::get('/kategori',[KategoriController::class,'index']);
// Route::get('/user',[UserController::class,'index']);
// Route::get('/user/tambah', [UserController::class, 'tambah']);
// Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
// Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
// Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
// Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']);        // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']);    // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']); // menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']);       // menyimpan data user baru
    Route::get('/{id}', [UserController::class, 'show']);     // menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']); // menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']);   // menyimpan perubahan data user
    Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
});

Route::group(['prefix' => 'level'], function () {
    Route::get('/', [LevelController::class, 'index']);        // Menampilkan daftar level
    Route::post('/list', [LevelController::class, 'list']);    // Menampilkan data level dalam JSON untuk datatables
    Route::get('/create', [LevelController::class, 'create']); // Menampilkan form tambah level
    Route::post('/', [LevelController::class, 'store']);       // Menyimpan level baru
    Route::get('/{id}', [LevelController::class, 'show']);     // Menampilkan detail level
    Route::get('/{id}/edit', [LevelController::class, 'edit']); // Menampilkan form edit level
    Route::put('/{id}', [LevelController::class, 'update']);   // Menyimpan perubahan data level
    Route::delete('/{id}', [LevelController::class, 'destroy']); // Menghapus level
});

Route::group(['prefix' => 'kategori'], function () {
    Route::get('/', [KategoriController::class, 'index']);        // Menampilkan daftar kategori
    Route::post('/list', [KategoriController::class, 'list']);    // Menampilkan data kategori dalam JSON untuk datatables
    Route::get('/create', [KategoriController::class, 'create']); // Menampilkan form tambah kategori
    Route::post('/', [KategoriController::class, 'store']);       // Menyimpan kategori baru
    Route::get('/{id}', [KategoriController::class, 'show']);     // Menampilkan detail kategori
    Route::get('/{id}/edit', [KategoriController::class, 'edit']); // Menampilkan form edit kategori
    Route::put('/{id}', [KategoriController::class, 'update']);   // Menyimpan perubahan data kategori
    Route::delete('/{id}', [KategoriController::class, 'destroy']); // Menghapus kategori
});

Route::group(['prefix' => 'barang'], function () {
    Route::get('/', [BarangController::class, 'index']);        // Menampilkan daftar Barang
    Route::post('/list', [BarangController::class, 'list']);    // Menampilkan data Barang dalam JSON untuk datatables
    Route::get('/create', [BarangController::class, 'create']); // Menampilkan form tambah Barang
    Route::post('/', [BarangController::class, 'store']);       // Menyimpan Barang baru
    Route::get('/{id}', [BarangController::class, 'show']);     // Menampilkan detail Barang
    Route::get('/{id}/edit', [BarangController::class, 'edit']); // Menampilkan form edit Barang
    Route::put('/{id}', [BarangController::class, 'update']);   // Menyimpan perubahan data Barang
    Route::delete('/{id}', [BarangController::class, 'destroy']); // Menghapus Barang
});