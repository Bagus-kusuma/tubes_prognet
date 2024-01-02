<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginApiController;
use App\Http\Controllers\UserApiController;
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

//BEGIN Route Auth
//Auth Register
Route::get('user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('user', [UserApiController::class, 'createUser']);
Route::get('user/{id}', [UserApiController::class, 'showUser']);
Route::patch('user/{id}', [UserApiController::class, 'updateUser']);
Route::delete('user', [UserApiController::class, 'deleteUser']);

//Auth Login
Route::post('login', LoginApiController::class)->middleware('guest:sanctum');

//Auth Logout
Route::post('logout', function(Request $request){
    return $request->user()->currentAccessToken()->delete();
})->middleware(['auth:sanctum']);
//END Route Auth


Route::apiResource('/agama', AgamaApiController::class)->middleware(['auth:sanctum']);
Route::apiResource('/krs', KrsApiController::class)->middleware(['auth:sanctum']);
Route::apiResource('/mahasiswa', MahasiswaApiController::class)->middleware(['auth:sanctum']);
Route::apiResource('/matakuliah', MatakuliahApiController::class)->middleware(['auth:sanctum']);
Route::apiResource('/detilkrs', DetilkrsApiController::class)->middleware(['auth:sanctum']);