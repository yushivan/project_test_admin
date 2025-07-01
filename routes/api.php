<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\PermohonanKtpController;
use App\Http\Controllers\Api\PerizinanUsahaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/customer', [CustomerController::class, 'store']);
Route::get('/customer/verify/{id}', [CustomerController::class, 'verify']);
Route::post('/customer/login', [CustomerController::class, 'login']);

Route::post('/permohonan-ktp', [PermohonanKtpController::class, 'store']);

Route::post('/perizinan-usaha', [PerizinanUsahaController::class, 'store']);