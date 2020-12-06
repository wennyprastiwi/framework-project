<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\KategoriPekerjaanAdminController;
use App\Http\Controllers\PenyediaKerjaAdminController;

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

Route::get('admin', [AdminController::class, 'index']);

Route::resource('admin/user', UserAdminController::class);

Route::resource('admin/kategori-pekerjaan', KategoriPekerjaanAdminController::class);

Route::resource('admin/penyedia-kerja', PenyediaKerjaAdminController::class);

Route::get('/admin/pencari-kerja', function () {
    return view('admin/pencari-kerja');
});

Route::get('/admin/lokasi', function () {
    return view('admin/lokasi');
});

Route::get('/admin/about-us', function () {
    return view('admin/about-us');
});

Route::get('/admin/contact', function () {
    return view('admin/contact');
});

Route::get('/admin/push-notifikasi', function () {
    return view('admin/push-notifikasi');
});

Route::get('admin/profile', [AdminController::class, 'profile']);

Route::get('admin/setting', [AdminController::class, 'setting']);