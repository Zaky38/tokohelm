@extends('layouts.admin')

@section('content')

<h3>Tambah Barang</h3>

<form action="/admin/barang" method="POST" enctype="multipart/form-data">
    
    @csrf
    <input type="text" name="nama_barang" class="form-control mb-2" placeholder="Nama Barang" required>
    <input type="number" name="rating" class="form-control mb-2" placeholder="Rating (1-5)" required>
    <textarea name="deskripsi_singkat" class="form-control mb-2" placeholder="Deskripsi"></textarea>
    <input type="text" name="ukuran" class="form-control mb-2" placeholder="Ukuran">
    <input type="number" name="quantity" class="form-control mb-2" placeholder="Stok">
    <input type="number" name="harga" class="form-control mb-2" placeholder="Harga">
    <input type="file" name="gambar" class="form-control mb-3">
    <button class="btn btn-success">Simpan</button>
    <a href="/admin/barang" class="btn btn-primary">Kembali</a>

</form>

@endsection