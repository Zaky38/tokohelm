@extends('layouts.app')

@section('content')

<div class="container">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                📦 Data Pesanan
            </h2>

            <h5>
                Kelola seluruh pesanan customer
            </h5>

        </div>

        <a
            href="/admin/dashboard"
            class="btn btn-primary shadow-sm"
        >
            ← Dashboard
        </a>

    </div>


    <!-- CARD TABLE -->
    <div class="card shadow-sm border-0">

        <div class="card-body">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>No</th>

                        <th>Kode Pesanan</th>

                        <th>Penerima</th>

                        <th>Total</th>

                        <th>Status</th>

                        <th class="text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @php $no = 1; @endphp

                    @foreach($pesanans as $pesanan)

                    <tr>

                        <td>
                            {{ $no++ }}
                        </td>

                        <td>

                            <span class="fw-semibold">
                                {{ $pesanan->kode_pesanan }}
                            </span>

                        </td>

                        <td>
                            {{ $pesanan->nama_penerima }}
                        </td>

                        <td>

                            <span
                                class="
                                    badge
                                    bg-success
                                    fs-6
                                "
                            >

                                Rp
                                {{ number_format($pesanan->total_harga,0,',','.') }}

                            </span>

                        </td>

                        <td>

                            @if($pesanan->status == 'diproses')

                                <span class="badge bg-warning text-dark px-3 py-2 fs-6">
                                    Diproses
                                </span>

                            @elseif($pesanan->status == 'dikirim')

                                <span class="badge bg-primary">
                                    Dikirim
                                </span>

                            @elseif($pesanan->status == 'dibatalkan')

                                <span class="badge bg-danger">
                                    Dibatalkan
                                </span>

                            @elseif($pesanan->status == 'selesai')

                                <span class="badge bg-success">
                                    Selesai
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    {{ $pesanan->status }}
                                </span>

                            @endif

                        </td>

                        <td class="text-center">

                            <a
                                href="{{ url('/admin/pesanan/'.$pesanan->id) }}"
                                class="btn btn-primary btn-sm shadow-sm"
                            >

                                🔍 Detail

                            </a>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection