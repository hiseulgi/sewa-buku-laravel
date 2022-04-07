<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeminjamController extends Controller{
    public function lihat_data_peminjam(){
        $peminjam = [
            'Jessica',
            'Maryono',
            'Bagus',
            'Sugab'
        ];
        return view('peminjams/lihat_data_peminjam', compact('peminjam'));
    }
}
