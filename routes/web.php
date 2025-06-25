<?php

use App\Http\Controllers\AtletController;
use App\Http\Controllers\CaborController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\PelatihController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/search-nik', [AtletController::class, 'SearchNik'])->name('search-nik');

Auth::routes(['register' => false, 'password.request' => false, 'password.reset' => false, 'password.email' => false]);
Route::middleware(['auth:web'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // chart admin
    Route::get('/chart-atlet', [App\Http\Controllers\HomeController::class, 'chartAtlet'])->name('chart-atlet');
    // update user
    Route::post('/users/store',  [UserController::class, 'store'])->name('users.store');
    //akun managemen
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //pelatih managemen
    Route::get('/pelatih', [PelatihController::class, 'index'])->name('pelatih');
    Route::post('/pelatih/store',  [PelatihController::class, 'store'])->name('pelatih.store');
    Route::delete('/pelatih/delete/{id}',  [PelatihController::class, 'destroy'])->name('pelatih.delete');
    Route::get('/pelatih-datatable', [PelatihController::class, 'getPelatihDataTable']);
    //atlet managemen

    Route::get('/atlet', [AtletController::class, 'index'])->name('atlet');
    Route::post('/atlet/store',  [AtletController::class, 'store'])->name('atlet.store');
    Route::post('/atlet/store-tinjauan',  [AtletController::class, 'storeTinjauan'])->name('atlet.store-tinjauan');
    Route::get('/atlet/edit/{id}',  [AtletController::class, 'edit'])->name('atlet.edit');
    Route::get('/atlet/detail/{id}',  [AtletController::class, 'detail'])->name('atlet.detail');
    Route::delete('/atlet/delete/{id}',  [AtletController::class, 'destroy'])->name('atlet.delete');
    Route::get('/atlet-datatable', [AtletController::class, 'getAtletDataTable']);
    //kabupaten managemen
    Route::get('/kabupaten', [KabupatenController::class, 'index'])->name('kabupaten');
    Route::post('/kabupaten/store',  [KabupatenController::class, 'store'])->name('kabupaten.store');
    Route::get('/kabupaten/edit/{id}',  [KabupatenController::class, 'edit'])->name('kabupaten.edit');
    Route::delete('/kabupaten/delete/{id}',  [KabupatenController::class, 'destroy'])->name('kabupaten.delete');
    Route::get('/kabupaten-datatable', [KabupatenController::class, 'getKabupatenDataTable']);
    //cabor managemen
    Route::get('/cabor', [CaborController::class, 'index'])->name('cabor');
    Route::post('/cabor/store',  [CaborController::class, 'store'])->name('cabor.store');
    Route::get('/cabor/edit/{id}',  [CaborController::class, 'edit'])->name('cabor.edit');
    Route::delete('/cabor/delete/{id}',  [CaborController::class, 'destroy'])->name('cabor.delete');
    Route::get('/cabor-datatable', [CaborController::class, 'getCaborDataTable']);
    Route::post('/nomor-pertandingan/store', [CaborController::class, 'storeNomor'])->name('nomor.store');
    Route::get('/nomor-pertandingan/edit/{id}', [CaborController::class, 'editNomor'])->name('nomor.edit');
    // report
    Route::get('/laporan-pelatih', [ReportController::class, 'pelatih'])->name('laporan-pelatih');
    Route::get('/laporan-atlet', [ReportController::class, 'atlet'])->name('laporan-atlet');
});
Route::middleware(['auth:web', 'role:Admin'])->group(function () {
    //user managemen
    Route::get('/users', [UserController::class, 'index'])->name('users');
    // Route::post('/users/store',  [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}',  [UserController::class, 'edit'])->name('users.edit');
    Route::get('/users/verification/{id}',  [UserController::class, 'verification'])->name('users.verification');
    Route::get('/users/reset-password/{id}',  [UserController::class, 'resetPassword'])->name('users.reset-password');
    Route::delete('/users/delete/{id}',  [UserController::class, 'destroy'])->name('users.delete');
    Route::get('/users-datatable', [UserController::class, 'getUsersDataTable']);
    Route::get('/operator-by-kabupaten/{id}', [UserController::class, 'getByKabupaten']);
});
