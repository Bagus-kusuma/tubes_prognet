<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KrsApiController;
use App\Http\Controllers\AgamaApiController;
use App\Http\Controllers\DetilkrsApiController;
use App\Http\Controllers\MahasiswaApiController;
use App\Http\Controllers\MatakuliahApiController;

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

Route::apiResource('/agama', AgamaApiController::class);
Route::apiResource('/krs', KrsApiController::class);
Route::apiResource('/mahasiswa', MahasiswaApiController::class);
Route::apiResource('/matakuliah', MatakuliahApiController::class);
Route::apiResource('/detilkrs', DetilkrsApiController::class);