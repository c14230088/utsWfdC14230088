<?php

use App\Http\Controllers\JadwalsController;
use Illuminate\Support\Facades\Route;

Route::get('/pesan', [JadwalsController::class, 'pesanView'])->name('pesanView');
Route::post('/pesan', [JadwalsController::class, 'pesan'])->name('pesanLap');

Route::get('/pesanan', [JadwalsController::class, 'pesananView'])->name('pesananView');
Route::get('/edit/{id}', [JadwalsController::class, 'editPesanView']);
Route::delete('/edit/{id}', [JadwalsController::class, 'del']);