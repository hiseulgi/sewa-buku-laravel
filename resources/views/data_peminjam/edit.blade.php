@extends('layout.master')
@section('content')
<div class="container">
  <h4>Edit Data Peminjam</h4>

  <form method="POST" action="{{ route('data_peminjam.update', $peminjam->id) }}">
    @csrf
    <div class="form-group">
      <label>Kode Peminjam</label>
      <input readonly type="text" name="kode_peminjam" class="form-control" value="{{ $peminjam->kode_peminjam }}">
    </div>

    <div class="form-group">
      <label>Nama Peminjam</label>
      <input type="text" name="nama_peminjam" class="form-control" value="{{ $peminjam->nama_peminjam }}">
    </div>

    <div class="form-group">
      <label>Jenis Kelamin</label>
      <select class="form-control" name="jenis_kelamin">
        @if($peminjam->jenis_kelamin=="P")
        <option value="L">Laki-laki</option>
        <option value="P" selected>Perempuan</option>
        @else if($peminjam->jenis_kelamin=="L")
        <option value="L" selected>Laki-laki</option>
        <option value="P">Perempuan</option>
        @endif
      </select>
    </div>

    <div class="form-group">
      <label>Tanggal Lahir</label>
      <input type="date" name="tanggal_lahir" class="form-control" value="{{ $peminjam->tanggal_lahir }}">
    </div>

    <div class="form-group">
      <label>Alamat</label>
      <textarea name="alamat" cols="148" rows="3" class="form-control">{{ $peminjam->alamat }}</textarea>
    </div>

    <div class="form-group">
      <label>Pekerjaan</label>
      <input type="text" name="pekerjaan" class="form-control" value="{{ $peminjam->pekerjaan }}">
    </div>

    <div class="form-group">
      <label>Telepon</label>
      <input type="text" name="nomor_telepon" class="form-control" value="{{ $peminjam->nomor_telepon }}">
    </div>

    <div>
      <button class="btn btn-primary" type="submit">Simpan</button>
    </div>
  </form>

</div>
@endsection