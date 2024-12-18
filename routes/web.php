<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IdentitasController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\PegawaiController;
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
    Route::get('/document-kategori/{slug}', [FrontController::class, 'documentCategory'])->name('document.kategori');
    Route::get('/document/{slug}', [FrontController::class, 'document'])->name('document.baca');
    Route::get('/staf-dan-pimpinan', [FrontController::class, 'pegawai'])->name('pegawai');
    Route::post('/pengaduan', [FrontController::class, 'pengaduan'])->name('pengaduan');
    Route::post('/pencarian', [FrontController::class, 'cari'])->name('pencarian');
});

// administrator
Route::prefix('admin')->middleware(['auth', 'role:superadmin|operator'])->group(function () {
    Route::get('pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('pengaduan/excel', [PengaduanController::class, 'cetak'])->name('pengaduan.cetak');
    Route::get('pengaduan/{pengaduan}/show', [PengaduanController::class, 'show'])->name('pengaduan.show');
    Route::post('pengaduan/{pengaduan}/validasi', [PengaduanController::class, 'validasi'])->name('pengaduan.validasi');
    Route::post('pengaduan/{pengaduan}/tanggapan', [PengaduanController::class, 'tanggapan'])->name('pengaduan.tanggapan');
    Route::delete('pengaduan/{pengaduan}/destroy', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');

    Route::resource('post', PostController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('service', ServiceController::class);
    Route::resource('link', LinkController::class);
    Route::resource('document', DocumentController::class);
    Route::resource('pegawai', PegawaiController::class);
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
