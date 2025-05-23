<?php

use App\Http\Controllers\AntrianController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatController;
use Illuminate\Support\Facades\Route;

// Halaman utama (welcome page)
Route::get('/', function () {
    return view('index');
})->middleware('guest');



Route::get('/pelanggan', [AntrianController::class, 'pelangganIndex'])
     ->name('pelanggan');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route to the antrian page
Route::get('/antrian', [AntrianController::class, 'index'])->name('antrian');
// Dashboard route untuk menampilkan halaman dashboard

// Satu rute dashboard utama
Route::get('/dashboard', [AntrianController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile routes untuk mengedit profile user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // Menampilkan form edit profile
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Menyimpan update profile
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Menghapus profile
});

// Route untuk halaman create dan store antrian
Route::middleware('auth')->group(function () {
    Route::get('antrian/create', [AntrianController::class, 'create'])->name('antrian.create'); // Menampilkan form tambah antrian
    Route::post('antrian', [AntrianController::class, 'store'])->name('antrian.store'); // Menyimpan antrian
});

// Route untuk menampilkan halaman daftar antrian (index)
Route::middleware('auth')->group(function () {
    Route::get('antrian', [AntrianController::class, 'index'])->name('antrian.index'); // Menampilkan daftar antrian
});

// Route untuk halaman edit antrian (edit form)
Route::middleware('auth')->group(function () {
    Route::get('antrian/{id_antrian}/edit', [AntrianController::class, 'edit'])->name('antrian.edit'); // Menampilkan form edit antrian
    Route::patch('antrian/{id_antrian}', [AntrianController::class, 'update'])->name('antrian.update'); // Menyimpan update antrian
    Route::put('antrian/{id}', [AntrianController::class, 'update'])->name('antrian.update'); // Alternatif untuk update antrian
    Route::patch('/antrian/{id_antrian}/status', [AntrianController::class, 'updateStatus'])->name('antrian.updateStatus'); // Update status antrian
});

// Route untuk menghapus antrian
Route::middleware('auth')->group(function () {
    Route::delete('antrian/{id_antrian}', [AntrianController::class, 'destroy'])->name('antrian.destroy'); // Menghapus antrian
});

// Route untuk update status antrian langsung dari dashboard
Route::patch('antrian/{id_antrian}/updateStatus', [AntrianController::class, 'updateStatus'])->name('antrian.updateStatus');

// Route untuk melakukan pencarian pada riwayat
Route::get('/riwayats/search', [RiwayatController::class, 'search'])->name('riwayats.search');

// Karyawan routes
Route::middleware('auth')->group(function () {
    Route::resource('karyawan', KaryawanController::class); // CRUD untuk karyawan
});

// Route untuk pencarian antrian
Route::get('/antrian/search', [AntrianController::class, 'search'])->name('antrian.search');

// Route untuk menampilkan riwayat antrian
Route::get('/riwayats', [RiwayatController::class, 'index'])->name('riwayats.index');

// Route untuk menyalin data selesai dari antrian ke riwayat
Route::post('/riwayats/salin', [RiwayatController::class, 'salinDataSelesai'])->name('riwayats.salin');

// Route untuk export data riwayat ke excel
Route::get('/riwayats/export', [RiwayatController::class, 'export'])->name('riwayats.export');

// Authentication routes (login, register, etc.)
require __DIR__.'/auth.php';
