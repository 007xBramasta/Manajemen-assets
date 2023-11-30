<?php

use App\Http\Controllers\Api\AssetController;
use App\Http\Controllers\Api\AuthController;
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

// route post untuk register, dimana akan memanggil fungsi register pada AuthController
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// route group untuk semua route yang membutuhkan autentikasi
Route::group(['middleware' => ['auth:sanctum']], function () {
    // route post untuk logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // route resource untuk asset
    Route::apiResource('assets', AssetController::class);
    Route::post('/assets/{id}', [AssetController::class, 'update']);
});
