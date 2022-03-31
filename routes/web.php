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
    return view('index');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/data_peminjam', function () {
    return view('peminjams/data_peminjam');
});

Route::get('lihat_data_peminjam', function () {
    $peminjam = [
        'Jessica',
        'Maryono',
        'Bagus',
        'Sugab'
    ];
    return view('peminjams/lihat_data_peminjam', compact('peminjam'));
});

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