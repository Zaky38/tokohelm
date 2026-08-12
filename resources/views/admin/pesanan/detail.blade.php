@extends('layouts.app')

@section('content')

<div class="container">

    <!-- HEADER -->
    <div
        class="
            d-flex
            justify-content-between
            align-items-center
            mb-4
        "
    >

        <div>

            <h2 class="fw-bold mb-1">
                📦 Detail Pesanan
            </h2>

            <h7 class="text-muted fs-6">
                Informasi lengkap pesanan customer
            </h7>

        </div>

        <a
            href="{{ url('/admin/pesanan') }}"
            class="btn btn-primary shadow-sm"
        >
            ← Kembali
        </a>

    </div>


    <!-- CARD INFO -->
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="row">

                <div class="col-md-4 mb-3">

                    <h5 class="text-muted">
                        Penerima
                    </h5>

                    <h5 class="fw-semibold">
                        {{ $pesanan->nama_penerima }}
                    </h5>

                </div>


                <div class="col-md-4 mb-3">

                    <h5 class="text-muted">
                        Alamat
                    </h5>

                    <h5 class="fw-semibold">
                        {{ $pesanan->alamat }}
                    </h5>

                </div>


                <div class="col-md-4 mb-3">

                    <h5 class="text-muted">
                        Status Pesanan
                    </h5>

                    <div class="mt-2">

                        @if($pesanan->status == 'diproses')

                            <span class="badge bg-warning text-dark px-3 py-2 fs-6">
                                Diproses
                            </span>

                        @elseif($pesanan->status == 'dikirim')

                            <span class="btn btn-primary shadow-sm">
                                Dikirim
                            </span>

                        @elseif($pesanan->status == 'dibatalkan')

                            <span class="badge bg-danger px-3 py-2 fs-6">
                                Dibatalkan
                            </span>

                        @elseif($pesanan->status == 'selesai')

                            <span class="badge bg-success px-3 py-2 fs-6">
                                Selesai
                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- TABLE -->
    <div class="card shadow-sm border-0">

        <div class="card-body">

            <table class="table table-hover align-middle fs-6">

                <thead class="table-light">

                    <tr>

                        <th>Barang</th>

                        <th width="120">
                            Qty
                        </th>

                        <th width="220">
                            Subtotal
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($pesanan->pesanan_details as $item)

                    <tr>

                        <td class="fw-semibold">

                            {{ $item->barang->nama_barang ?? '-' }}

                        </td>

                        <td>

                            <span
                                class="badge px-3 py-2"
    
                                style="
                                background:#e3f2fd;
                                color:#0d6efd;
                                font-size:15px;
                                "
                                >

                            {{ $item->quantity }}

                            </span>

                        </td>

                        <td>

                            <span
                                class="
                                    badge
                                    bg-success
                                    px-3
                                    py-2
                                    fs-6
                                "
                            >

                                Rp
                                {{ number_format($item->subtotal,0,',','.') }}

                            </span>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>


@if(
    $pesanan->status == 'diproses'
    &&
    $pesanan->status_pembayaran == 'sudah_bayar'
)

<!-- BUKTI TRANSFER -->
<div class="card shadow-sm border-0 mt-4 mb-4">

    <div class="card-body text-center">

        <h4 class="mb-4 fw-bold">
            📷 Bukti Transfer
        </h4>

        <img
            src="{{ asset('bukti_transfer/'.$pesanan->bukti_transfer) }}"
            class="img-fluid rounded shadow"

            style="
                max-width:450px;
                width:100%;
                cursor:pointer;
                transition:.3s;
                object-fit:cover;
            "

            onclick="
                window.open(
                    this.src,
                    '_blank'
                )
            "

            onmouseover="
                this.style.transform='scale(1.03)'
            "

            onmouseout="
                this.style.transform='scale(1)'
            "
        >

        <div class="text-muted mt-3">
            Klik gambar untuk melihat ukuran penuh
        </div>

    </div>

</div>

@endif


@if(
    $pesanan->status == 'diproses'
    &&
    $pesanan->status_pembayaran == 'sudah_bayar'
)

<!-- ACTION BUTTON -->
<div
    class="
        d-flex
        align-items-center
        mt-4
    "

    style="
        gap:18px;
    "
>

    <form
        action="{{ url('/admin/pesanan/'.$pesanan->id.'/kirim') }}"
        method="POST"
    >

        @csrf

        <button
            class="
                btn
                btn-success
                shadow-sm
                px-4
                py-2
            "
        >

            ✅ Kirim Pesanan

        </button>

    </form>


    <form
    action="{{ url('/admin/pesanan/'.$pesanan->id.'/batal') }}"
    method="POST"

    style="
        margin-left:4px;
    "
>

        @csrf

        <button
            type="submit"

            class="
                btn
                btn-danger
                shadow-sm
                px-4
                py-2
            "

            onclick="
                return confirm(
                    'Batalkan pesanan ini?'
                )
            "
        >

            ❌ Batalkan

        </button>

    </form>

</div>

@endif

</div>

@endsection