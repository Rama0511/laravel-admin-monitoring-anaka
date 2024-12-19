<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\ImunisasiController;
use App\Http\Controllers\PerkembanganController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/dashboard', [AuthController::class, 'dashboard']); // Hapus middleware auth jika tidak digunakan
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/children/{email}', [AuthController::class, 'showChildren'])->name('children');
Route::get('/detail/{email}', [AuthController::class, 'showDetail'])->name('detail');
Route::get('/twins/{email}', [AuthController::class, 'showTwins'])->name('twins');
Route::get('/perkiraan/{email}', [AuthController::class, 'perkiraan_kelahiran'])->name('perkiraan');
Route::get('/perkembangan1/{email}', [AuthController::class, 'perkembangan1'])->name('perkembangan1');
Route::get('/perkembangan2/{bulan}/{nama}', [AuthController::class, 'perkembangan2'])->name('perkembangan2');


Route::get('/perkembangan/create', [PerkembanganController::class, 'create'])->name('perkembangan.create');
Route::post('/perkembangan/store', [PerkembanganController::class, 'store'])->name('perkembangan.store');
Route::get('/perkembangan/edit/{id}', [PerkembanganController::class, 'edit'])->name('perkembangan.edit');
Route::patch('/perkembangan/update/{id}', [PerkembanganController::class, 'update'])->name('perkembangan.update'); // Pastikan ini menggunakan PATCH
Route::delete('/perkembangan/destroy/{id}', [PerkembanganController::class, 'destroy'])->name('perkembangan.destroy');


Route::get('/consultation', [ConsultationController::class, 'index'])->name('consultation.index');
Route::post('/consultation/store', [ConsultationController::class, 'store'])->name('consultation.store');
Route::get('/consultation/edit/{email}/{consultationId}', [ConsultationController::class, 'edit'])->name('consultation.edit');
Route::post('/consultation/update/{email}/{consultationId}', [ConsultationController::class, 'update'])->name('consultation.update');


Route::get('/imunisasi', [ImunisasiController::class, 'index'])->name('imunisasi.index');
Route::post('/imunisasi/store', [ImunisasiController::class, 'store'])->name('imunisasi.store');
Route::get('/imunisasi/edit/{email}/{imunisasiId}', [ImunisasiController::class, 'edit'])->name('imunisasi.edit');
Route::post('/imunisasi/update/{email}/{imunisasiId}', [ImunisasiController::class, 'update'])->name('imunisasi.update');