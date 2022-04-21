<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPeminjam;

class DataPeminjamController extends Controller
{
    public function index(){
        $data_peminjam = DataPeminjam::all()->sortBy('nama_peminjam');
        $jumlah_peminjam = $data_peminjam->count();
        return view('data_peminjam.index', compact('data_peminjam','jumlah_peminjam'));
    }

    public function create(){
        return view('data_peminjam.create');
    }

    public function store(Request $request){
        $data_peminjam = new DataPeminjam;
        $data_peminjam->kode_peminjam = $request->kode_peminjam;
        $data_peminjam->nama_peminjam = $request->nama_peminjam;
        $data_peminjam->jenis_kelamin = $request->jenis_kelamin;
        $data_peminjam->tanggal_lahir = $request->tanggal_lahir;
        $data_peminjam->alamat = $request->alamat;
        $data_peminjam->pekerjaan = $request->pekerjaan;
        $data_peminjam->save();
        return redirect('data_peminjam');
    }

    public function edit($id){
        $peminjam = DataPeminjam::find($id);
        return view('data_peminjam.edit', compact('peminjam'));
    }

    public function update(Request $request, $id){
        $data_peminjam = DataPeminjam::find($id);
        $data_peminjam->kode_peminjam = $request->kode_peminjam;
        $data_peminjam->nama_peminjam = $request->nama_peminjam;
        $data_peminjam->jenis_kelamin = $request->jenis_kelamin;
        $data_peminjam->tanggal_lahir = $request->tanggal_lahir;
        $data_peminjam->alamat = $request->alamat;
        $data_peminjam->pekerjaan = $request->pekerjaan;
        $data_peminjam->update();
        return redirect('data_peminjam');
    }

    public function destroy($id){
        $data_peminjam = DataPeminjam::find($id);
        $data_peminjam->destroy($id);
        return redirect('data_peminjam');
    }
}
