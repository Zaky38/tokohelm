@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="fw-bold">
            📦 Data Barang
        </h3>

        <small class="text-muted">
            Kelola seluruh produk toko
        </small>
    </div>

    <a
        href="/admin/barang/create"
        class="btn btn-success shadow-sm"
    >
        + Tambah Barang
    </a>

</div>


<div class="card shadow-sm border-0">

    <div class="card-body">

        <table class="table table-hover align-middle">

            <thead class="table-light">

                <tr>

                    <th>No</th>

                    <th>Produk</th>

                    <th>Harga</th>

                    <th class="text-center">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($barangs as $b)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>


                    <td>

                        <div class="d-flex align-items-center">

                            <img
                                src="{{ asset('uploads/'.$b->gambar) }}"
                                width="70"
                                height="70"

                                style="
                                    object-fit:cover;
                                    border-radius:12px;
                                "
                            >

                            <div class="ms-3">

                                <div class="fw-semibold">

                                    {{ $b->nama_barang }}

                                </div>

                                <small class="text-muted">

                                    Stok:
                                    {{ $b->quantity }}

                                </small>

                            </div>

                        </div>

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
                            {{ number_format($b->harga,0,',','.') }}

                        </span>

                    </td>


                    <td class="text-center">

                        <a
                            href="/admin/barang/{{ $b->id }}/edit"

                            class="
                                btn
                                btn-warning
                                btn-sm
                            "
                        >

                            ✏️ Edit

                        </a>


                        <form
                            action="/admin/barang/{{ $b->id }}"
                            method="POST"

                            style="
                                display:inline;
                            "
                        >

                            @csrf

                            @method('DELETE')

                            <button

                                class="
                                    btn
                                    btn-danger
                                    btn-sm
                                "

                                onclick="
                                    return confirm(
                                        'Yakin mau hapus?'
                                    )
                                "

                            >

                                🗑️ Hapus

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td
                        colspan="4"
                        class="
                            text-center
                            text-muted
                            py-5
                        "
                    >

                        📦 Belum ada data barang

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


<div class="mt-4">

    <a
        href="/admin/dashboard"
        class="btn btn-primary shadow-sm"
    >

        ← Dashboard

    </a>

</div>

@endsection