@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('history') }}" class="btn btn-primary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ url('history') }}">Riwayat Pemesanan</a>
                    </li>
                    <li class="breadcrumb-item active">Detail Pemesanan</li>
                </ol>
            </nav>
        </div>

        <div class="col-md-12">

            <!-- STATUS PESANAN -->
<div class="card">

    <div class="card-body">

        @if($pesanan->status == 'dibatalkan')

            <h3>❌ Pesanan Dibatalkan</h3>

            <h5>
                Pesanan anda dibatalkan oleh admin, Silakan hubungi admin jika ada pertanyaan.<br>
                WhatsApp Admin 0812345678910
            </h5>

        @elseif($pesanan->status == 'diproses')

            <h3>✅ Pembayaran Berhasil</h3>

            <h5>
                Pesanan anda sedang diproses.<br>
                Mohon menunggu konfirmasi pengiriman.
            </h5>

        @elseif($pesanan->status == 'dikirim')

            <h3>🚚 Pesanan Sedang Dikirim</h3>

            <h5>
                Pesanan anda sedang dalam proses pengiriman.<br>
                Terimakasih sudah berbelanja di HelmKu.
            </h5>

        @elseif($pesanan->status == 'selesai')

            <h3>🎉 Pesanan Selesai</h3>

            <h5>
                Pesanan telah diterima.<br>
                Terimakasih sudah berbelanja di HelmKu.
            </h5>

        @else

            <h3>📦 Detail Pesanan</h3>

            <h5>
                Status pesanan sedang diperbarui.
            </h5>

        @endif

    </div>

</div>

            <!-- DETAIL -->
            <div class="card mt-2">
                <div class="card-body">

                    <h3><i class="fa fa-shopping-cart"></i> Detail Pemesanan</h3>

                    @if(!empty($pesanan))
                    <div class="text-end mb-3">
                    Tanggal Pesan :
                    <strong>{{ $pesanan->tanggal }}</strong>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 1; ?>

                            @foreach($pesanan_details as $pesanan_detail)
                            <tr>
                                <td>{{ $no++ }}</td>

                                <td>
                                    @if($pesanan_detail->barang)

                                <img
                                    src="{{ url('uploads/'.$pesanan_detail->barang->gambar) }}"
                                    width="100"
                                    >

                                    @else

                                    -

                                    @endif
                                </td>

                                <td>{{ $pesanan_detail->barang->nama_barang ?? '-' }}</td>

                                <td>{{ $pesanan_detail->quantity }}</td>

                                <td align="right">
                                    Rp. {{ number_format($pesanan_detail->harga) }}
                                </td>

                                <td align="right">
                                    Rp. {{ number_format($pesanan_detail->subtotal) }}
                                </td>
                            </tr>
                            @endforeach

                            <!-- TOTAL -->
                            <tr>
                                <td colspan="5" align="right">
                                    <strong>Total Harga :</strong>
                                </td>
                                <td align="right">
                                    <strong>
                                        Rp. {{ number_format($pesanan->total_harga) }}
                                    </strong>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>
@endsection