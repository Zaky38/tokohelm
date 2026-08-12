@extends('layouts.admin')

@section('content')

<style>

    .dashboard-card{
        border:none;
        border-radius:18px;
        transition:.25s;
    }

    .dashboard-card:hover{
        transform:translateY(-4px);
    }

    .dashboard-icon{
        width:55px;
        height:55px;
        border-radius:14px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:24px;
    }

    .stat-title{
        font-size:15px;
        color:#6c757d;
        margin-bottom:6px;
    }

    .stat-value{
        font-size:28px;
        font-weight:700;
    }

</style>


<!-- HEADER -->
<div class="card shadow-sm border-0 p-4 mb-4 dashboard-card">

    <div class="d-flex justify-content-between align-items-center">

        <div>

            <h3 class="fw-bold mb-1">
                Dashboard Admin
            </h3>

            <small class="text-muted fs-6">
                Halo, {{ auth()->user()->name }}
            </small>

            <p class="text-muted mt-2 mb-0">
                Selamat datang di halaman admin HelmKu.
            </p>

        </div>

        <div
            class="dashboard-icon"
            style="
                background:#e8f0ff;
                color:#0d6efd;
            "
        >
            📊
        </div>

    </div>

</div>



<!-- STATISTIK -->
<div class="row g-4 mb-4">


    <!-- TOTAL BARANG -->
    <div class="col-md-3">

        <div class="card shadow-sm p-4 dashboard-card h-100">

            <div class="d-flex justify-content-between">

                <div>

                    <div class="stat-title">
                        Total Barang
                    </div>

                    <div class="stat-value">
                        {{ $barangs->count() }}
                    </div>

                </div>

                <div
                    class="dashboard-icon"
                    style="
                        background:#e8f0ff;
                        color:#0d6efd;
                    "
                >
                    📦
                </div>

            </div>

        </div>

    </div>



    <!-- TOTAL PENJUALAN -->
    <div class="col-md-3">

        <div class="card shadow-sm p-4 dashboard-card h-100">

            <div class="d-flex justify-content-between">

                <div>

                    <div class="stat-title">
                        Total Penjualan
                    </div>

                    <div class="stat-value fs-4">
                        Rp {{ number_format($totalPenjualan,0,',','.') }}
                    </div>

                </div>

                <div
                    class="dashboard-icon"
                    style="
                        background:#dcfce7;
                        color:#16a34a;
                    "
                >
                    💰
                </div>

            </div>

        </div>

    </div>



    <!-- PENJUALAN HARI INI -->
    <div class="col-md-3">

        <div class="card shadow-sm p-4 dashboard-card h-100">

            <div class="d-flex justify-content-between">

                <div>

                    <div class="stat-title">
                        Penjualan Hari Ini
                    </div>

                    <div class="stat-value fs-4">
                        Rp {{ number_format($penjualanHariIni,0,',','.') }}
                    </div>

                </div>

                <div
                    class="dashboard-icon"
                    style="
                        background:#fff7d6;
                        color:#ca8a04;
                    "
                >
                    🛒
                </div>

            </div>

        </div>

    </div>



    <!-- BARANG TERJUAL -->
    <div class="col-md-3">

        <div class="card shadow-sm p-4 dashboard-card h-100">

            <div class="d-flex justify-content-between">

                <div>

                    <div class="stat-title">
                        Barang Terjual Hari Ini
                    </div>

                    <div class="stat-value">
                        {{ $barangTerjualHariIni }}
                    </div>

                </div>

                <div
                    class="dashboard-icon"
                    style="
                        background:#ede9fe;
                        color:#7c3aed;
                    "
                >
                    📈
                </div>

            </div>

        </div>

    </div>



    <!-- BARANG DIBATALKAN -->
    <div class="col-md-3">

        <div class="card shadow-sm p-4 dashboard-card h-100">

            <div class="d-flex justify-content-between">

                <div>

                    <div class="stat-title">
                        Barang Dibatalkan Hari Ini
                    </div>

                    <div class="stat-value">
                        {{ $barangDibatalkanHariIni }}
                    </div>

                </div>

                <div
                    class="dashboard-icon"
                    style="
                        background:#fee2e2;
                        color:#dc2626;
                    "
                >
                    ❌
                </div>

            </div>

        </div>

    </div>

</div>



<!-- BUTTON -->
<div class="mt-4 d-flex gap-3">

    <a
        href="/admin/barang"
        class="btn btn-primary px-4 py-2 shadow-sm"
    >
        📦 Kelola Produk
    </a>

    <a
        href="/admin/pesanan"
        class="btn btn-success px-4 py-2 shadow-sm"
    >
        🧾 Kelola Pesanan
    </a>

</div>

@endsection