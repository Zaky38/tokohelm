@extends('layouts.admin')

@section('content')

<h3>Edit Barang</h3>

<form action="/admin/barang/{{ $barang->id }}" method="POST" enctype="multipart/form-data">
    
    @csrf
    @method('PUT')
    <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}" class="form-control mb-2">
    <input type="number" name="rating" value="{{ $barang->rating }}" class="form-control mb-2">
    <textarea name="deskripsi_singkat" class="form-control mb-2">{{ $barang->deskripsi_singkat }}</textarea>
    <input type="text" name="ukuran" value="{{ $barang->ukuran }}" class="form-control mb-2">
    <input type="number" name="quantity" value="{{ $barang->quantity }}" class="form-control mb-2">
    <input type="number" name="harga" value="{{ $barang->harga }}" class="form-control mb-2">
    <p>Gambar sekarang:</p>
    <img src="{{ asset('uploads/' . $barang->gambar) }}" width="100">
    <input type="file" name="gambar" class="form-control mt-2">
    <button class="btn btn-success mt-4">Update</button>
    <a href="/admin/barang" class="btn btn-primary mt-4">Kembali</a>

</form>

@endsection