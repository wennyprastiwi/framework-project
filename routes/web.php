<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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

Route::get('/admin', function () {
    return view('admin/dashboard');
});

Route::get('/admin/user', function () {
    return view('admin/user');
});

Route::get('/admin/jenis-pekerjaan', function () {
    return view('admin/jenis-pekerjaan');
});

Route::get('/admin/penyedia-kerja', function () {
    return view('admin/penyedia-kerja');
});

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

Route::get('/admin/profile', function () {
    return view('admin/profile');
});

Route::get('/admin/setting', function () {
    return view('admin/setting');
});


// Route::resource('Admins', AdminController::class);
