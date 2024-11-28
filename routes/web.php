<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\JabatanController;
use App\Models\Karyawan;

// Auth routes
Route::get('/', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/', [AuthController::class, 'proseslogin']);
Route::get('/auth/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/auth/register', [AuthController::class, 'ProsesRegister']);

// Dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// Karyawan routes
Route::get('/karyawan', [KaryawanController::class, 'karyawan'])->middleware('auth')->name('karyawan.karyawan');
Route::post('/karyawan/store', [KaryawanController::class, 'store'])->name('karyawan.store');
Route::post('/karyawan/edit', [KaryawanController::class, 'edit'])->middleware('auth');
Route::post('/karyawan/{id}/update', [KaryawanController::class,'update'] );
Route::post('/karyawan/{id}/delete', [KaryawanController::class,'delete'] ); 

// Jabatan routes
Route::get('/jabatan', [JabatanController::class, 'jabatan'])->middleware('auth')->name('jabatan.jabatan');
Route::post('/jabatan', [JabatanController::class, 'store'])->name('jabatan.store');
Route::post('/jabatan/edit', [JabatanController::class, 'edit'])->middleware('auth');
Route::post('/jabatan/{id}/update', [JabatanController::class,'update'] );
Route::post('/jabatan/{id}/delete', [JabatanController::class,'delete'] ); 

//gaji
Route::get('/gaji', [GajiController::class, 'gaji'])->middleware('auth')->name('gaji.gaji');
Route::post('/gaji', [GajiController::class, 'store'])->name('gaji.store');
Route::post('/gaji/edit', [GajiController::class, 'edit'])->middleware('auth');
Route::get('/get-jabatan/{id}', [GajiController::class, 'getJabatan']);
Route::post('/gaji/{id}/update', [GajiController::class,'update'] );

//slip gaji
Route::get('/slipgaji', [GajiController::class, 'slipgaji'])->middleware('auth')->name('slipgaji.slipgaji');
Route::get('/slipgaji/cetakpdf', [GajiController::class, 'cetakpdf'])->middleware('auth');
Route::get('gaji/cetakpdf/{id?}', [GajiController::class, 'cetakpdf'])->name('slipgaji.cetakpdf');
// Route untuk download semua slip gaji dalam format PDF
Route::get('/gaji/download-all-pdf', [GajiController::class, 'downloadAllPdf'])->name('gaji.downloadAllPdf');



