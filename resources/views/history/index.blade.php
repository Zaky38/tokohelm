@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ url('dashboard') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="col-md-12 mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Riwayat Pemesanan</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3><i class="fa fa-history"></i> Riwayat Pemesanan</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Jumlah Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($pesanans as $pesanan)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $pesanan->tanggal }}</td>
                                        <td>
                                        @if($pesanan->status_pembayaran == 'belum_bayar')
                                            Belum dibayar

                                        @elseif($pesanan->status == 'diproses')
                                            Sudah dibayar (sedang diproses)

                                        @elseif($pesanan->status == 'dikirim')
                                            Sedang dalam proses pengiriman

                                        @elseif($pesanan->status == 'selesai')
                                            Selesai

                                        @elseif($pesanan->status == 'dibatalkan')
                                            Pesanan dibatalkan
                                            
                                        @endif
                                        </td>
                                        <td>Rp. {{ number_format($pesanan->total_harga) }}</td>
                                        <td>

                                        <a
                                            href="{{ url('history/'.$pesanan->id) }}"
                                            class="btn btn-primary"
                                        >
                                            Detail
                                        </a>

                                        @if($pesanan->status == 'dikirim')

                                            <a
                                                href="{{ url('struk/'.$pesanan->id) }}"
                                                class="btn btn-success"
                                                >
                                                    Download Struk
                                                </a>

                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
