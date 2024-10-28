<?php

use App\Http\Controllers\Api\AntrianController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/list-instansi', [AntrianController::class, 'list_instansi']);
Route::get('/ambil-antrian/{instansi_id}/{uuid}', [AntrianController::class, 'ambil_antrian']);
Route::get('/list-antrian-instansi/{instansi_id}/{uuid}', [AntrianController::class, 'list_antrian_instansi']);
