@extends('layout.master')
@section('content')
<div class="container">
  <h4>Tambah Data Peminjam</h4>

  <form method="POST" action="{{ route('data_peminjam.store') }}">
    @csrf
    <div class="form-group">
      <label>Kode Peminjam</label>
      <input type="text" name="kode_peminjam" class="form-control">
    </div>

    <div class="form-group">
      <label>Nama Peminjam</label>
      <input type="text" name="nama_peminjam" class="form-control">
    </div>

    <div class="form-group">
      <label>Tanggal Lahir</label>
      <input type="date" name="tanggal_lahir" class="form-control">
    </div>

    <div class="form-group">
      <label>Alamat</label>
      <textarea name="alamat" cols="148" rows="3" class="form-control"></textarea>
    </div>

    <div class="form-group">
      <label>Pekerjaan</label>
      <input type="text" name="pekerjaan" class="form-control">
    </div>

    <div class="form-group">
      <label>Telepon</label>
      <input type="text" name="telepon" class="form-control">
    </div>

    <div class="form-group">
      <label>Jenis Kelamin</label>
      <select class="form-control" name="id_jenis_kelamin">
        <option value="">Pilih Jenis Kelamin</option>
        @foreach ($list_jenis_kelamin as $key => $value)
        <option value="{{ $key }}">
          {{ $value }}
        </option>
        @endforeach
      </select>
    </div>

    <div>
      <button class="btn btn-primary" type="submit">Simpan</button>
    </div>
  </form>

</div>
@endsection