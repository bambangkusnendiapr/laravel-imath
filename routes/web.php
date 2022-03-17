<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LembarKerjaController;
use App\Http\Controllers\Admin\Kelas\KelasController;
use App\Http\Controllers\Admin\Kuis\KuisController;
use App\Http\Controllers\Admin\Latihan\LatihanController;
use App\Http\Controllers\Admin\Materi\MateriController;
use App\Http\Controllers\Admin\Semester\SemesterController;
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
Route::post('/login-post', [LoginViewController::class, 'loginpost'])->name('login.post');
Route::get('/cek-role', [CekRoleController::class, 'index'])->name('cek.role');
Route::get('/logout', [LogoutViewController::class, 'index'])->name('logout.log');

Route::get('/register', [RegisterBaruController::class, 'index'])->name('register');
Route::post('/register-post', [RegisterBaruController::class, 'registerpost'])->name('register.post');



Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function() {
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/lembar-kerja', LembarKerjaController::class);

    Route::resource('/materi', MateriController::class);
    Route::resource('/latihan', LatihanController::class);
    Route::resource('/kuis', KuisController::class);
    Route::resource('/kelas', KelasController::class);
    Route::resource('/semester', SemesterController::class);
    Route::resource('/nilai', SemesterController::class);
});


// MAHASISWA ROUTE
Route::group(['prefix' => 'mahasiswa', 'middleware' => ['role:mahasiswa|admin']], function() {
    Route::get('/app', [AppController::class, 'index'])->name('app.index');

    Route::resource('/summary', DashboardUserController::class);
    Route::resource('/materi-ongoing', MateriOngoingController::class);
    Route::resource('/studi-kasus', StudiKasusController::class);
    Route::post('/jawabanPengetahuan', [StudiKasusController::class, 'jawabanPengetahuan'])->name('jawaban.pengetahuan');

    Route::resource('/latihan-ongoing', OngoingLatihanController::class);
    Route::resource('/kuis-ongoing', OngoingKuisController::class);

    Route::resource('/jawaban-latihan', JawabanLatihanController::class);


});

Auth::routes();
