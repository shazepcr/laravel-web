<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController; // 1. TAMBAHKAN IMPORT INI

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('halaman-about');
});

Route::get('/pcr', function () {
    return 'Selamat Datang di Website Kampus PCR!';
});

Route::get('/mahasiswa', function () {
    return 'Halo Mahasiswa dari kelas 2 SI C';
})->name('mahasiswa.show');

Route::get('/nama/{param1}', function ($param1) {
    return 'Nama saya: '.$param1;
});

Route::get('/nim/{param1?}', function ($param1 = '') {
    return 'NIM saya: '.$param1;
});

Route::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show']);

Route::get('/matakuliah/show/{kode?}', [MatakuliahController::class, 'show']);

Route::resource('matakuliah', MatakuliahController::class)->except(['show']);

Route::get('/home', [HomeController::class, 'index']);

// 2. TAMBAHKAN ROUTE GET INI UNTUK MEMBUKA FORM (home.blade.php)
Route::get('/question', function () {
    return view('home');
});

// Route POST untuk memproses submit form
Route::post('/question/store', [QuestionController::class, 'store'])
        ->name('question.store');
