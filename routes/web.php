<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IdentitasController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\InstansiLayananController;
use App\Http\Controllers\KepuasanMasyarakatController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true, 'register' => false]);

Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('cari', [FrontController::class, 'cari'])->name('cari');

// front
Route::as('front.')->group(function () {
    Route::get('/post', [FrontController::class, 'post'])->name('post.index');
    Route::get('/post/{slug}', [FrontController::class, 'post'])->name('post.baca');
    Route::get('/kategori/{slug}', [FrontController::class, 'kategori'])->name('post.kategori');
    Route::get('/fasilitas/{slug}', [FrontController::class, 'fasilitas'])->name('fasilitas.baca');
    Route::get('/instansi/{slug}', [FrontController::class, 'instansi'])->name('instansi');
    Route::get('/layanan/{slug}', [FrontController::class, 'layanan'])->name('layanan');
    Route::post('/pengaduan', [FrontController::class, 'pengaduan'])->name('pengaduan');
    Route::get('/skm/{instansi}', [FrontController::class, 'skmCreate'])->name('skm.create');
    Route::post('/skm/{instansi}/store', [FrontController::class, 'skmStore'])->name('skm.store');
    Route::get('/skmqr/create', [FrontController::class, 'skmQrCreate'])->name('skmqr.create');
    Route::post('/skmqr/store', [FrontController::class, 'skmQrStore'])->name('skmqr.store');
});

// administrator
Route::prefix('admin')->middleware(['auth', 'role:superadmin|operator|instansi'])->group(function () {
    Route::resource('instansi', InstansiController::class);
    Route::get('rekap-antrian', [InstansiController::class, 'antrianRekap'])->name('instansi.antrian.rekap');
    Route::get('rekap-antrian-instansi/{instansi}', [InstansiController::class, 'antrianRekapInstansi'])->name('instansi.antrian.rekap.instansi');
    Route::get('rekap-antrian-excel', [InstansiController::class, 'antrianRekapExcel'])->name('instansi.antrian.rekap.excel');
    Route::get('rekap-antrian-detail/{instansi}', [InstansiController::class, 'antrianRekapDetail'])->name('instansi.antrian.rekap.detail');
    Route::get('instansi/{instansi}/antrian', [InstansiController::class, 'antrian'])->name('instansi.antrian');
    Route::get('instansi/{instansi}/antrian-excel', [InstansiController::class, 'antrianExcel'])->name('instansi.antrian.excel');
    Route::post('instansi/antrian/simpan_layanan_antrian', [InstansiController::class, 'simpan_layanan_antrian'])->name('instansi.simpan_layanan_antrian');
    Route::get('instansi/{instansi}/qrcode', [InstansiController::class, 'qrcode'])->name('instansi.qrcode');
    Route::get('instansi/layanan/create/{instansi}', [InstansiLayananController::class, 'create'])->name('instansi.layanan.create');
    Route::post('instansi/layanan/{instansi}/store', [InstansiLayananController::class, 'store'])->name('instansi.layanan.store');
    Route::get('instansi/layanan/{layanan}/edit', [InstansiLayananController::class, 'edit'])->name('instansi.layanan.edit');
    Route::patch('instansi/layanan/{layanan}/update', [InstansiLayananController::class, 'update'])->name('instansi.layanan.update');
    Route::delete('instansi/layanan/{layanan}/destroy', [InstansiLayananController::class, 'destroy'])->name('instansi.layanan.destroy');

    Route::get('pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('pengaduan/{pengaduan}/show', [PengaduanController::class, 'show'])->name('pengaduan.show');
    Route::post('pengaduan/{pengaduan}/validasi', [PengaduanController::class, 'validasi'])->name('pengaduan.validasi');
    Route::post('pengaduan/{pengaduan}/tanggapan', [PengaduanController::class, 'tanggapan'])->name('pengaduan.tanggapan');
    Route::delete('pengaduan/{pengaduan}/destroy', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');
    Route::resource('kepuasan', KepuasanMasyarakatController::class);
});

// manajemen blog
Route::prefix('admin')->group(function () {
    Route::resource('post', PostController::class)->middleware(['auth', 'role:superadmin|operator|instansi']);
    Route::middleware(['auth', 'role:superadmin|operator'])->group(function () {
        Route::resource('category', CategoryController::class);
        Route::resource('service', ServiceController::class);
    });
});

// profile akun
Route::middleware(['verified'])->group(function () {
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/store', [UserProfileController::class, 'store'])->name('profile.store');
    Route::post('/profile/change-password', [UserProfileController::class, 'changePasswordStore'])->name('profile.change-password');
});

// master user
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::post('user/{user}/change-password/', [UserController::class, 'changePassword'])->name('user.change-password');
    Route::post('user/{user}/{status}/banned/', [UserController::class, 'banned'])->name('user.banned');
    Route::resource('user', UserController::class);
    Route::resource('identitas', IdentitasController::class);
});

// summernote
Route::post('summernote-upload-image', function () {
    $file = request()->image;
    $fileName = microtime().'.'.$file->extension();
    $file->move('storage/summernote/', $fileName);

    return asset('storage/summernote/'.$fileName);
})->name('summernote.upload.image');
