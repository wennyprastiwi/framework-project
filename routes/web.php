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

Route::group(['prefix' => 'admin'], function() {
    Route::get('', 'AdminController@index')->name('admin.index');
    Route::get('user', 'AdminController@user')->name('admin.user');
    Route::get('kategori-pekerjaan', 'AdminController@kategoriPekerjaan')->name('admin.kategoriPekerjaan');
    Route::get('penyedia-kerja', 'AdminController@penyediaKerja')->name('admin.penyediaKerja');
    Route::get('pencari-kerja', 'AdminController@pencariKerja')->name('admin.pencariKerja');
    Route::get('about-us', 'AdminController@aboutUs')->name('admin.aboutUs');
    Route::get('kontak', 'AdminController@kontak')->name('admin.kontak');
    Route::get('login', 'AdminController@login')->name('admin.login');
    Route::post('auth','AdminController@authCheck')->name('admin.auth');

    Route::group(['prefix' => 'user'], function() {
        Route::get('create', 'UserController@create')->name('user.create');
        Route::get('{id}/show', 'UserController@show')->name('user.show');
        Route::get('{id}/edit', 'UserController@edit')->name('user.edit');

        Route::post('store', 'UserController@store')->name('user.store');
        Route::post('update', 'UserController@update')->name('user.update');
        Route::delete('{id}/delete', 'UserController@delete')->name('user.delete');
    });

    Route::group(['prefix' => 'kategoriPekerjaan'], function() {
        Route::get('create', 'KategoriPekerjaanController@create')->name('kategoriPekerjaan.create');
        Route::get('{id}/show', 'KategoriPekerjaanController@show')->name('kategoriPekerjaan.show');
        Route::get('{id}/edit', 'KategoriPekerjaanController@edit')->name('kategoriPekerjaan.edit');

        Route::post('store', 'KategoriPekerjaanController@store')->name('kategoriPekerjaan.store');
        Route::post('update', 'KategoriPekerjaanController@update')->name('kategoriPekerjaan.update');
        Route::delete('{id}/delete', 'KategoriPekerjaanController@delete')->name('kategoriPekerjaan.delete');
    });


    Route::group(['prefix' => 'penyediaKerja'], function() {
        Route::get('create', 'PenyediaKerjaController@create')->name('penyediaKerja.create');
        Route::get('{id}/show', 'PenyediaKerjaController@show')->name('penyediaKerja.show');
        Route::get('{id}/edit', 'PenyediaKerjaController@edit')->name('penyediaKerja.edit');
        Route::get('{id}/accepted', 'PenyediaKerjaController@accepted')->name('penyediaKerja.accepted');
        Route::get('{id}/decline', 'PenyediaKerjaController@decline')->name('penyediaKerja.decline');


        Route::post('getkota', 'PenyediaKerjaController@getKota')->name('penyediaKerja.kota');
        Route::post('getkecamatan', 'PenyediaKerjaController@getKecamatan')->name('penyediaKerja.kecamatan');
        Route::post('getkelurahan', 'PenyediaKerjaController@getKelurahan')->name('penyediaKerja.kelurahan');

        Route::post('store', 'PenyediaKerjaController@store')->name('penyediaKerja.store');
        Route::post('update', 'PenyediaKerjaController@update')->name('penyediaKerja.update');

        Route::delete('{id}/delete', 'PenyediaKerjaController@delete')->name('penyediaKerja.delete');
    });


    Route::group(['prefix' => 'pencariKerja'], function() {
        Route::get('create', 'PencariKerjaController@create')->name('pencariKerja.create');
        Route::get('{id}/show', 'PencariKerjaController@show')->name('pencariKerja.show');
        Route::get('{id}/edit', 'PencariKerjaController@edit')->name('pencariKerja.edit');
        Route::get('{id}/accepted', 'PencariKerjaController@accepted')->name('pencariKerja.accepted');
        Route::get('{id}/decline', 'PencariKerjaController@decline')->name('pencariKerja.decline');

        Route::post('store', 'PencariKerjaController@store')->name('pencariKerja.store');
        Route::post('update', 'PencariKerjaController@update')->name('pencariKerja.update');

        Route::delete('{id}/delete', 'PencariKerjaController@delete')->name('pencariKerja.delete');
    });
});


