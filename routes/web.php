<?php


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;


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




Route::get('/home', [HomeController::class, 'index'])
    ->name('home');




// 2. TAMBAHKAN ROUTE GET INI UNTUK MEMBUKA FORM (home.blade.php)
Route::get('/question', function () {
    return view('home');
});


// Route POST untuk memproses submit form
Route::post('/question/store', [QuestionController::class, 'store'])
        ->name('question.store');


Route::get('/home-question-respon', function () {
    return view('home-question-respon');
})->name('home-question-respon');


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');


Route::resource('pelanggan', PelangganController::class); //Resource semua function yg dijalankan dipanggil dengan controller PelangganController
