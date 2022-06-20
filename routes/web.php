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

Route::get('/', 'IndexController@index');

Route::get('home', function () {
    return view('home');
});

// peminjaman route group
Route::get('peminjaman', 'PeminjamanController@index');
Route::get('peminjaman/create', 'PeminjamanController@create')->name('peminjaman.create');
Route::post('peminjaman/store', 'PeminjamanController@store')->name('peminjaman.store');
Route::get('peminjaman/detail_peminjam/{id}', 'PeminjamanController@detail_peminjam')->name('peminjaman.detail_peminjam');
Route::get('peminjaman/detail_buku/{id}', 'PeminjamanController@detail_buku')->name('peminjaman.detail_buku');

// data_peminjam Route group
Route::get('data_peminjam', 'DataPeminjamController@index');
Route::get('data_peminjam/create', 'DataPeminjamController@create')->name('data_peminjam.create');
Route::post('data_peminjam/store', 'DataPeminjamController@store')->name('data_peminjam.store');
Route::get('data_peminjam/edit/{id}', 'DataPeminjamController@edit')->name('data_peminjam.edit');
Route::post('data_peminjam/update/{id}', 'DataPeminjamController@update')->name('data_peminjam.update');
Route::post('data_peminjam/delete/{id}', 'DataPeminjamController@destroy')->name('data_peminjam.destroy');
Route::get('data_peminjam/search', 'DataPeminjamController@search')->name('data_peminjam.search');
// EOF data_peminjam Route group

// Latihan Collection Route
// Route::get('coba_collection', 'DataPeminjamController@CobaCollection');
// Route::get('col_first', 'DataPeminjamController@colFirst');
// Route::get('col_last', 'DataPeminjamController@colLast');
// Route::get('col_count', 'DataPeminjamController@colCount');
// Route::get('col_take', 'DataPeminjamController@colTake');
// Route::get('col_pluck', 'DataPeminjamController@colPluck');
// Route::get('col_where', 'DataPeminjamController@colWhere');
// Route::get('col_wherein', 'DataPeminjamController@colWhereIn');
// Route::get('col_toarray', 'DataPeminjamController@colToArray');
// Route::get('col_tojson', 'DataPeminjamController@colToJson');
// EOF Latihan Collection

// Route::get('lihat_data_peminjam', 'PeminjamController@lihat_data_peminjam');

// Jobsheet 2

// Route::get('/biodata', function(){
//     return 'Nama : Sugab <br> Nim : 4.33.20.0.17 <br> Alamat : Baskoro <br> Hobi : Wibu';
// });

// Route::get('/mahasiswa/{prodi}', function($prodi){
//     return 'Mahasiswa prodi : '.$prodi;
// });

// Route::get('/mahasiswa2/{prodi?}', function($prodi=null){
//     if ($prodi == null) return 'Data program studi kosong';
//     return 'Mahasiswa prodi : '.$prodi;
// });

// Route::get('/mahasiswa3/{prodi?}', function($prodi='Teknologi Rekayasa Komputer'){
//     return 'Mahasiswa prodi : '.$prodi;
// });

// Route::get('/biodata2', function(){
//     return view('biodata2');
// });

// Route::group([], function(){
//     Route::get('/pertama', function(){
//         echo 'route pertama';
//     });
//     Route::get('/kedua', function(){
//         echo 'route kedua';
//     });
//     Route::get('/ketiga', function(){
//         echo 'route ketiga';
//     });
// });

// Route::group(['prefix' => 'latihan'], function(){
//     Route::get('/satu', function(){
//         echo 'Latihan 1';
//     });
//     Route::get('/dua', function(){
//         echo 'Latihan 2';
//     });
//     Route::get('/tiga', function(){
//         echo 'Latihan 3';
//     });
// });

// Route::group(['prefix' => 'admin'], function(){
//     Route::get('/', function(){
//         return 'Halaman Home Admin';
//     });
//     Route::get('/posts', function(){
//         return 'Halaman Input Data Buku';
//     });
//     Route::get('/posts/simpan', function(){
//         return 'Data berhasil disimpan';
//     });
// });

// Route::name('kuliah')->group(function(){
//     Route::get('Teknologi Rekayasa Komputer', function(){
//         return 'Kuliah di Program Studi Teknologi Rekayasa Komputer';
//     });
// });

// END OF JOBSHEET 2