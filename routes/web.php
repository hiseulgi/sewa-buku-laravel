<?php

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
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('peminjaman', 'PeminjamanController@index')->name('peminjaman.index');
Route::get('peminjaman/create', 'PeminjamanController@create')->name('peminjaman.create');
Route::post('peminjaman/store', 'PeminjamanController@store')->name('peminjaman.store');
Route::get('peminjaman/detail_peminjam/{id}', 'PeminjamanController@detail_peminjam')->name('peminjaman.detail_peminjam');
Route::get('peminjaman/detail_buku/{id}', 'PeminjamanController@detail_buku')->name('peminjaman.detail_buku');

// data_peminjam Route group
Route::get('data_peminjam', 'DataPeminjamController@index')->name('data_peminjam.index');
Route::get('data_peminjam/create', 'DataPeminjamController@create')->name('data_peminjam.create');
Route::post('data_peminjam/store', 'DataPeminjamController@store')->name('data_peminjam.store');
Route::get('data_peminjam/edit/{id}', 'DataPeminjamController@edit')->name('data_peminjam.edit');
Route::post('data_peminjam/update/{id}', 'DataPeminjamController@update')->name('data_peminjam.update');
Route::post('data_peminjam/delete/{id}', 'DataPeminjamController@destroy')->name('data_peminjam.destroy');
Route::get('data_peminjam/search', 'DataPeminjamController@search')->name('data_peminjam.search');

// user Route Group
Route::get('user', 'UserController@index')->name('user.index');
Route::get('user/create', 'UserController@create')->name('user.create');
Route::post('user/store', 'UserController@store')->name('user.store');
Route::get('user/edit/{id}', 'UserController@edit')->name('user.edit');
Route::post('user/update/{id}', 'UserController@update')->name('user.update');
Route::post('user/destroy/{id}', 'UserController@destroy')->name('user.destroy');

// book Route Group
Route::get('buku', 'BukuController@index')->name('buku.index');
Route::get('buku/create', 'BukuController@create')->name('buku.create');
Route::post('buku', 'BukuController@store')->name('buku.store');
Route::get('buku/edit/{id}', 'BukuController@edit')->name('buku.edit');
Route::post('buku/update/{id}', 'BukuController@update')->name('buku.update');
Route::post('buku/delete/{id}', 'BukuController@destroy')->name('buku.destroy');