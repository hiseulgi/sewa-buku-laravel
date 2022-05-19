<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPeminjam;
use App\Models\Telepon;

class DataPeminjamController extends Controller {
    public function index() {
        $data_peminjam = DataPeminjam::all()->sortBy('nama_peminjam');
        $jumlah_peminjam = $data_peminjam->count();
        return view('data_peminjam.index', compact('data_peminjam', 'jumlah_peminjam'));
    }

    public function create() {
        return view('data_peminjam.create');
    }

    public function store(Request $request) {
        $data_peminjam = new DataPeminjam;
        $data_peminjam->kode_peminjam = $request->kode_peminjam;
        $data_peminjam->nama_peminjam = $request->nama_peminjam;
        $data_peminjam->jenis_kelamin = $request->jenis_kelamin;
        $data_peminjam->tanggal_lahir = $request->tanggal_lahir;
        $data_peminjam->alamat = $request->alamat;
        $data_peminjam->pekerjaan = $request->pekerjaan;
        $data_peminjam->save();

        $telepon = new Telepon;
        $telepon->nomor_telepon = $request->telepon;
        $data_peminjam->telepon()->save($telepon);
        return redirect('data_peminjam');
    }

    public function edit($id) {
        $peminjam = DataPeminjam::find($id);
        if (!empty($peminjam->telepon->nomor_telepon)){
            $peminjam->nomor_telepon = $peminjam->telepon->nomor_telepon;
        }
        return view('data_peminjam.edit', compact('peminjam'));
    }

    public function update(Request $request, $id) {
        $data_peminjam = DataPeminjam::find($id);
        $data_peminjam->kode_peminjam = $request->kode_peminjam;
        $data_peminjam->nama_peminjam = $request->nama_peminjam;
        $data_peminjam->jenis_kelamin = $request->jenis_kelamin;
        $data_peminjam->tanggal_lahir = $request->tanggal_lahir;
        $data_peminjam->alamat = $request->alamat;
        $data_peminjam->pekerjaan = $request->pekerjaan;
        $data_peminjam->update();

        // update nomor telepon, jika sudah ada nomor telepon
        if ($data_peminjam->telepon){
            // jika telepon diisi maka update
            if ($request->filled('nomor_telepon')){
                $telepon = $data_peminjam->telepon;
                $telepon->nomor_telepon = $request->input('nomor_peminjam');
                $data_peminjam->telepon()->save($telepon);
            } else {
                // jika tidak diisi maka hapus nomor telepon
                $data_peminjam->telepon()->delete();
            }
        } else {
            // buat data baru, jika sebelumnya tidak ada nomor telepon
            if($request->filled('nomor_telepon')){
                $telepon = new Telepon;
                $telepon->nomor_telepon = $request->nomor_telepon;
                $data_peminjam->telepon()->save($telepon);
            }
        }

        return redirect('data_peminjam');
    }

    public function destroy($id) {
        $data_peminjam = DataPeminjam::find($id);
        $data_peminjam->destroy($id);
        return redirect('data_peminjam');
    }

    // Latihan Collection
    public function CobaCollection() {
        $list = [
            'Zhuge Liang',
            'Sugab Gaming',
            'Anya',
            'Sang Senja',
            'Nakuro'
        ];

        $collection = collect($list)->map(function ($nama) {
            return ucwords($nama);
        });
        return $collection;
    }

    public function colFirst() {
        $collection = DataPeminjam::all()->first();
        return $collection;
    }

    public function colLast() {
        $collection = DataPeminjam::all()->last();
        return $collection;
    }

    public function colCount() {
        $collection = DataPeminjam::all();
        $jumlah = $collection->count();
        return 'Jumah peminjam : ' . $jumlah;
    }

    public function colTake() {
        $collection = DataPeminjam::all()->take(2);
        return $collection;
    }

    public function colPluck() {
        $collection = DataPeminjam::all()->pluck("nama_peminjam");
        return $collection;
    }

    public function colWhere() {
        $collection = DataPeminjam::all()->where('kode_peminjam', 'P004');
        return $collection;
    }

    public function colWhereIn() {
        $collection = DataPeminjam::all()->whereIn('kode_peminjam', ['P004', 'P001']);
        return $collection;
    }

    public function colToArray() {
        $collection = DataPeminjam::select('kode_peminjam', 'nama_peminjam')->take(3)->get();
        $arr = $collection->toArray();
        foreach ($arr as $peminjam) {
            echo $peminjam['kode_peminjam'] . ' - ' . $peminjam['nama_peminjam'] . '<br>';
        }
    }

    public function colToJson() {
        $data = [
            ['id'=>'P001','nama'=>'Sugab'],
            ['id'=>'P002','nama'=>'Anya'],
            ['id'=>'P003','nama'=>'Iru'],
            ['id'=>'P004','nama'=>'Diva'],
            ['id'=>'P005','nama'=>'Near']
        ];
        $collection = collect($data)->toJson();
        return $collection;
    }
}
