<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LembarKerjaController;
use App\Http\Controllers\Admin\Kelas\KelasController;
use App\Http\Controllers\Admin\Kuis\KuisController;
use App\Http\Controllers\Admin\Latihan\LatihanController;
use App\Http\Controllers\Admin\Materi\MateriController;
use App\Http\Controllers\Admin\Semester\SemesterController;
use App\Http\Controllers\Admin\Nilai\NilaiController;
use App\Http\Controllers\Auth\CekRoleController;
use App\Http\Controllers\Auth\LoginViewController;
use App\Http\Controllers\Auth\LogoutViewController;
use App\Http\Controllers\Auth\RegisterBaruController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\JawabanLatihanController;
use App\Http\Controllers\Ongoing\MateriOngoingController;
use App\Http\Controllers\Ongoing\OngoingKuisController;
use App\Http\Controllers\Ongoing\OngoingLatihanController;
use App\Http\Controllers\StudiKasus\StudiKasusController;
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginViewController::class, 'index'])->name('login.view');
Route::get('/cek-role', [CekRoleController::class, 'index'])->name('cek.role');
Route::post('/login-post', [LoginViewController::class, 'loginpost'])->name('login.post');
Route::get('/logout', [LogoutViewController::class, 'index'])->name('logout.log');


Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function() {
    Route::resource('/dashboard', DashboardController::class);

    Route::resource('/materi', MateriController::class);
    Route::post('/pengetahuan-tambah', [MateriController::class, 'pengetahuanTambah'])->name('pengetahuan.tambah');
    Route::put('/pengetahuan-update/{id}', [MateriController::class, 'pengetahuanUpdate'])->name('pengetahuan.update');
    Route::delete('/pengetahuan-hapus/{id}', [MateriController::class, 'pengetahuanHapus'])->name('pengetahuan.hapus');

    Route::resource('/latihan', LatihanController::class);
    Route::resource('/nilai', NilaiController::class);
    Route::get('/nilai/{idUser}/{idMateri}/show', [NilaiController::class, 'nilaiShow'])->name('nilaiShow');
    Route::post('/nilai-latihan-store', [NilaiController::class, 'nilaiLatihan'])->name('nilai.latihan.store');

    Route::post('/soal-tambah', [LatihanController::class, 'soalTambah'])->name('soal.tambah');
    Route::put('/soal-update/{id}', [LatihanController::class, 'soalUpdate'])->name('soal.update');
    Route::delete('/soal-hapus/{id}', [LatihanController::class, 'soalHapus'])->name('soal.hapus');

    // Ganti Password
    Route::get('/ganti-password', [DashboardController::class, 'gantiPassword'])->name('ganti.password');
    Route::post('/ganti-password', [DashboardController::class, 'simpanGantiPassword'])->name('simpan.ganti.password');
});


// MAHASISWA ROUTE
Route::group(['middleware' => ['verified']], function() {
    Route::group(['prefix' => 'mahasiswa', 'middleware' => ['role:mahasiswa|admin']], function() {
        Route::get('/summary', function() {
            return redirect()->route('app.index');
        })->name('summary.index');
        Route::get('/app', [AppController::class, 'index'])->name('app.index');
        Route::get('/lembarKerja/{id}', [AppController::class, 'lembarKerja'])->name('lembar.kerja');
        Route::get('/lembarKerja/pengetahuan/{id}', [AppController::class, 'lembarKerjaPengetahuan'])->name('lembar.kerja.pengetahuan');
        Route::get('/lembarKerja/latihan/{id}', [AppController::class, 'lembarKerjaLatihan'])->name('lembar.kerja.latihan');

        Route::post('/jawabanPengetahuan', [StudiKasusController::class, 'jawabanPengetahuan'])->name('jawaban.pengetahuan');

        Route::resource('/jawaban-latihan', JawabanLatihanController::class);
    });
});

Auth::routes(['verify' => true]);
