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
    Route::get('index', 'AdminController@index')->name('admin.index');
    Route::get('user', 'AdminController@user')->name('admin.user');
    Route::get('kategori-pekerjaan', 'AdminController@kategoriPekerjaan')->name('admin.kategoriPekerjaan');
    Route::get('penyedia-kerja', 'AdminController@penyediaKerja')->name('admin.penyediaKerja');
});


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

    Route::get('getkota/{id}', 'PenyediaKerjaController@getKota')->name('penyediaKerja.kota');
    Route::get('getkecamatan/{id}', 'PenyediaKerjaController@getKecamatan')->name('penyediaKerja.kecamatan');
    Route::get('getkelurahan/{id}', 'PenyediaKerjaController@getKelurahan')->name('penyediaKerja.kelurahan');

    Route::post('store', 'PenyediaKerjaController@store')->name('penyediaKerja.store');
	Route::post('update', 'PenyediaKerjaController@update')->name('penyediaKerja.update');
	Route::delete('{id}/delete', 'PenyediaKerjaController@delete')->name('penyediaKerja.delete');
});
