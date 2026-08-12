@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            {{-- ALERT SUCCESS --}}
            @if(session('success'))
                <div class="col-md-12">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            
            <div class="col-md-12">
                <a href="{{ url('dashboard') }}" class="btn btn-primary">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="col-md-12 mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ $barang->nama_barang }}
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="col-md-12 mt-1">
                <div class="card">
                    <div class="card-body">

                        <div class="row">

                            <!-- GAMBAR PRODUK -->
                            <div class="col-md-6">
                                <img src="{{ asset('uploads/' . $barang->gambar) }}" class="rounded mx-auto d-block"
                                    width="100%">
                            </div>

                            <!-- DETAIL PRODUK -->
                            <div class="col-md-6 mt-3">

                                <h2>{{ $barang->nama_barang }}</h2>

                                <form method="post" action="{{ url('pesan/' . $barang->id) }}">
                                    @csrf

                                    <table class="table">

                                        <tr>
                                            <td width="150">Harga</td>
                                            <td width="10">:</td>
                                            <td>Rp {{ number_format($barang->harga) }}</td>
                                        </tr>

                                        <tr>
                                            <td>Stok</td>
                                            <td>:</td>
                                            <td>{{ $barang->quantity }}</td>
                                        </tr>

                                        <!-- PILIH UKURAN -->
                                        <tr>
                                            <td>Ukuran</td>
                                            <td>:</td>
                                            <td>
                                                <select name="ukuran" class="form-control" style="width:70px;" required>
                                                    @foreach(explode(',', $barang->ukuran) as $ukuran)
                                                        <option value="{{ trim($ukuran) }}">{{ trim($ukuran) }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>

                                        <!-- JUMLAH PESAN -->
                                        <tr>
                                            <td>Jumlah Pesan</td>
                                            <td>:</td>
                                            <td>
                                                <form method="post" action="{{ url('pesan') }}/{{ $barang->id }}">
                                                    @csrf
                                                    <input type="text" name="jumlah_pesan" class="form-control" required="">
                                                    <button type="submit" class="btn btn-primary mt-2"><i
                                                            class="fa fa-shopping-cart"></i> Masukkan Keranjang</button>
                                                </form>
                                            </td>
                                        </tr>

                                    </table>

                                </form>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection