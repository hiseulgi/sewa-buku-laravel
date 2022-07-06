<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPeminjam;
use App\Models\JenisKelamin;
use App\Models\Telepon;
use App\Models\User;
use Illuminate\Support\Facades\Session as Session;
use Illuminate\Support\Facades\Storage as Storage;

class DataPeminjamController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $jumlah_peminjam = DataPeminjam::count();
        $data_peminjam = DataPeminjam::orderBy('id', 'asc')->paginate(5);
        $no = 0;
        return view('data_peminjam.index', compact('data_peminjam', 'no', 'jumlah_peminjam'));
    }

    public function create() {
        $list_jenis_kelamin = JenisKelamin::pluck('nama_jenis_kelamin', 'id');
        return view('data_peminjam.create', compact('list_jenis_kelamin'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'kode_peminjam' => 'required|string',
            'nama_peminjam' => 'required|string|max:30',
            'tanggal_lahir' => 'required|date',
            'foto' => 'required|image|mimes:jpeg,jpg,png',
        ]);

        $foto_peminjam = $request->foto;
        $nama_file = time() . '.' . $foto_peminjam->getClientOriginalExtension();
        $foto_peminjam->move('foto_peminjam/', $nama_file);

        $data_peminjam = new DataPeminjam;
        $data_peminjam->kode_peminjam = $request->kode_peminjam;
        $data_peminjam->nama_peminjam = $request->nama_peminjam;
        $data_peminjam->id_jenis_kelamin = $request->id_jenis_kelamin;
        $data_peminjam->tanggal_lahir = $request->tanggal_lahir;
        $data_peminjam->alamat = $request->alamat;
        $data_peminjam->pekerjaan = $request->pekerjaan;
        $data_peminjam->foto = $nama_file;
        $data_peminjam->user_id = $request->user_id;
        $data_peminjam->save();

        $telepon = new Telepon;
        $telepon->nomor_telepon = $request->telepon;
        $data_peminjam->telepon()->save($telepon);

        Session::flash('flash_message', 'Data peminjam berhasil disimpan!');

        return redirect('data_peminjam');
    }

    public function edit($id) {
        $peminjam = DataPeminjam::find($id);
        if (!empty($peminjam->telepon->nomor_telepon)) {
            $peminjam->nomor_telepon = $peminjam->telepon->nomor_telepon;
        }
        $list_jenis_kelamin = JenisKelamin::pluck('nama_jenis_kelamin', 'id');

        return view('data_peminjam.edit', compact('peminjam', 'list_jenis_kelamin'));
    }

    public function update(Request $request, $id) {
        $data_peminjam = DataPeminjam::find($id);

        if ($request->has('foto')) {
            $foto_peminjam = $request->foto;
            $nama_file = time() . '.' . $foto_peminjam->getClientOriginalExtension();
            $foto_peminjam->move('foto_peminjam/', $nama_file);

            $data_peminjam->kode_peminjam = $request->kode_peminjam;
            $data_peminjam->nama_peminjam = $request->nama_peminjam;
            $data_peminjam->id_jenis_kelamin = $request->id_jenis_kelamin;
            $data_peminjam->tanggal_lahir = $request->tanggal_lahir;
            $data_peminjam->alamat = $request->alamat;
            $data_peminjam->foto = $nama_file;
            $data_peminjam->pekerjaan = $request->pekerjaan;

            $data_peminjam->update();

            // find user
            $user_id = DataPeminjam::where('id',$id)->pluck('user_id');
            $user = User::where('id',$user_id);
            $user->update(['name'=>$request->nama_peminjam]);
        } else {
            $data_peminjam->kode_peminjam = $request->kode_peminjam;
            $data_peminjam->nama_peminjam = $request->nama_peminjam;
            $data_peminjam->id_jenis_kelamin = $request->id_jenis_kelamin;
            $data_peminjam->tanggal_lahir = $request->tanggal_lahir;
            $data_peminjam->alamat = $request->alamat;
            $data_peminjam->pekerjaan = $request->pekerjaan;
            $data_peminjam->update();

            // find user
            $user_id = DataPeminjam::where('id',$id)->pluck('user_id');
            $user = User::where('id',$user_id);
            $user->update(['name'=>$request->nama_peminjam]);
        }

        // update nomor telepon, jika sudah ada nomor telepon
        if ($data_peminjam->telepon) {
            // jika telepon diisi maka update
            if ($request->filled('nomor_telepon')) {
                $telepon = $data_peminjam->telepon;
                $telepon->nomor_telepon = $request->input('nomor_telepon');
                $data_peminjam->telepon()->save($telepon);
            } else {
                // jika tidak diisi maka hapus nomor telepon
                $data_peminjam->telepon()->delete();
            }
        } else {
            // buat data baru, jika sebelumnya tidak ada nomor telepon
            if ($request->filled('nomor_telepon')) {
                $telepon = new Telepon;
                $telepon->nomor_telepon = $request->nomor_telepon;
                $data_peminjam->telepon()->save($telepon);
            }
        }

        Session::flash('flash_message', 'Data berhasil diupdate!');
        return redirect('data_peminjam');
    }

    public function destroy($id) {
        $user_id = DataPeminjam::where('id',$id)->pluck('user_id');
        $user = User::where('id',$user_id);
        $user->delete();
        
        $data_peminjam = DataPeminjam::find($id);
        $data_peminjam->delete();
        Session::flash('flash_message_hapus', 'Data peminjam berhasil dihapus');
        Session::flash('penting', true);
        return redirect('data_peminjam');
    }

    public function search(Request $request) {
        $batas = 5;
        $cari = $request->kata;
        $data_peminjam = DataPeminjam::where('nama_peminjam', 'like', '%' . $cari . '%')->paginate($batas);
        $no = $batas * ($data_peminjam->currentPage() - 1);
        return view('data_peminjam.search', compact('data_peminjam', 'no', 'cari'));
    }

    // Latihan Collection
    // public function CobaCollection() {
    //     $list = [
    //         'Zhuge Liang',
    //         'Sugab Gaming',
    //         'Anya',
    //         'Sang Senja',
    //         'Nakuro'
    //     ];

    //     $collection = collect($list)->map(function ($nama) {
    //         return ucwords($nama);
    //     });
    //     return $collection;
    // }

    // public function colFirst() {
    //     $collection = DataPeminjam::all()->first();
    //     return $collection;
    // }

    // public function colLast() {
    //     $collection = DataPeminjam::all()->last();
    //     return $collection;
    // }

    // public function colCount() {
    //     $collection = DataPeminjam::all();
    //     $jumlah = $collection->count();
    //     return 'Jumah peminjam : ' . $jumlah;
    // }

    // public function colTake() {
    //     $collection = DataPeminjam::all()->take(2);
    //     return $collection;
    // }

    // public function colPluck() {
    //     $collection = DataPeminjam::all()->pluck("nama_peminjam");
    //     return $collection;
    // }

    // public function colWhere() {
    //     $collection = DataPeminjam::all()->where('kode_peminjam', 'P004');
    //     return $collection;
    // }

    // public function colWhereIn() {
    //     $collection = DataPeminjam::all()->whereIn('kode_peminjam', ['P004', 'P001']);
    //     return $collection;
    // }

    // public function colToArray() {
    //     $collection = DataPeminjam::select('kode_peminjam', 'nama_peminjam')->take(3)->get();
    //     $arr = $collection->toArray();
    //     foreach ($arr as $peminjam) {
    //         echo $peminjam['kode_peminjam'] . ' - ' . $peminjam['nama_peminjam'] . '<br>';
    //     }
    // }

    // public function colToJson() {
    //     $data = [
    //         ['id'=>'P001','nama'=>'Sugab'],
    //         ['id'=>'P002','nama'=>'Anya'],
    //         ['id'=>'P003','nama'=>'Iru'],
    //         ['id'=>'P004','nama'=>'Diva'],
    //         ['id'=>'P005','nama'=>'Near']
    //     ];
    //     $collection = collect($data)->toJson();
    //     return $collection;
    // }
}
