@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="row justify-content-center">

        <!-- LOGO -->
        <div class="col-md-12 mb-5 text-center">

            <img
                src="{{ asset('images/helmlogo.png') }}"

                style="
                    width:260px;
                    max-width:100%;
                "
            >

        </div>


        @foreach($barangs as $barang)

        <div class="col-md-4 mb-4">

            <div
                class="card border-0 shadow-sm h-100"
                style="
                    border-radius:20px;
                    overflow:hidden;
                    transition:.3s;
                "

                onmouseover="
                    this.style.transform='translateY(-6px)';
                    this.style.boxShadow='0 10px 25px rgba(0,0,0,0.12)';
                "

                onmouseout="
                    this.style.transform='translateY(0)';
                    this.style.boxShadow='0 .125rem .25rem rgba(0,0,0,.075)';
                "
            >

                <!-- GAMBAR -->
                <div
                    class="text-center"
                    style="
                        background:#e9ecef;
                        padding:25px;
                    "
                >

                    <img
                        src="{{ asset('uploads/' . $barang->gambar) }}"

                        style="
                            width:180px;
                            height:180px;
                            object-fit:contain;
                        "
                    >

                </div>


                <!-- BODY -->
                <div class="card-body d-flex flex-column p-4">

                    <!-- LABEL -->
                    <small
                        style="
                            color:#0d6efd;
                            font-weight:600;
                        "
                    >
                        Helm Original
                    </small>


                    <!-- NAMA -->
                    <h4
                        class="fw-bold mt-2 mb-2"
                        style="
                            min-height:60px;
                        "
                    >
                        {{ $barang->nama_barang }}
                    </h4>


                    <!-- RATING -->
                    <div class="mb-3">

                        @for($i = 1; $i <= 5; $i++)

                            @if($i <= $barang->rating)

                                <i class="fa fa-star text-warning"></i>

                            @else

                                <i class="fa fa-star text-secondary"></i>

                            @endif

                        @endfor

                        <span class="text-muted">
                            ({{ $barang->rating }}/5)
                        </span>

                    </div>


                    <!-- DESKRIPSI -->
                    <p
    class="text-muted"
    style="
        font-size:14px;
        line-height:1.6;

        display:-webkit-box;
        line-clamp:3;
        -webkit-line-clamp:3;
        -webkit-box-orient:vertical;

        overflow:hidden;

        min-height:48px;
    "
>
                        {{ $barang->deskripsi_singkat }}
                    </p>

                    <hr>


                    <!-- DETAIL -->
<div
    class="mb-3"

    style="
        min-height:85px;
    "
>

    <p class="mb-2">

        <strong>Ukuran:</strong>

        <span
            class="badge bg-primary"
            style="
                font-size:13px;
            "
        >
            {{ $barang->ukuran }}
        </span>

    </p>

    <p class="mb-2">

        <strong>Stok:</strong>

        <span
            class="badge bg-success"
            style="
                font-size:13px;
            "
        >
            {{ $barang->quantity }}
        </span>

    </p>

</div>


                    <!-- HARGA -->
                    <div
                        class="mb-4"

                        style="
                            min-height:60px;
                            "
                        >

                        <h4
                            class="fw-bold"
                            style="
                                color:#0d6efd;
                            "
                        >
                            Rp {{ number_format($barang->harga, 0, ',', '.') }}
                        </h4>

                    </div>


                    <!-- BUTTON -->
                    <div class="mt-auto">

                        <a
                            href="{{ url('pesan/' . $barang->id) }}"

                            class="
                                btn
                                btn-primary
                                w-100
                                fw-semibold
                            "

                            style="
                                border-radius:12px;
                                padding:12px;
                            "
                        >

                            <i class="fa fa-shopping-cart"></i>

                            Pesan Sekarang

                        </a>

                    </div>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

@endsection