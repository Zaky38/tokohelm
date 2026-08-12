<!DOCTYPE html>
<html>

<head>
    <title>Struk</title>
    <link rel="icon" href="{{ asset('images/icon.png') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 15px;
            font-variation-settings: 'wdth' 100, 'wght' 400;
            color: #333;
        }

        .container {
            padding: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo {
            width: 80px;
            margin-bottom: 5px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
        }

        .info {
            margin-bottom: 15px;
        }

        .info p {
            margin: 3px 0;
        }

        .box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            background: #f9f9f9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background: #333;
            color: #fff;
            font-size: 12px;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .total {
            font-size: 14px;
            font-weight: bold;
            margin-top: 10px;
        }

        .status {
            margin-top: 5px;
            color: green;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 11px;
            color: #777;
        }

        .invoice-title {
            font-size: 20px;
            /* agak dibesarin dikit */
            font-weight: 700;
            /* bold tegas */
            margin-top: 10px;
            /* turun ke bawah */
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- HEADER -->
        <div class="header">
            <img src="{{ public_path('images/helmlogo.png') }}" class="logo">
            <div class="invoice-title">Invoice Pembayaran</div>
        </div>

        <!-- INFO -->
        <div class="box info">
            <p><strong>Kode Pesanan:</strong> {{ $pesanan->kode_pesanan }}</p>
            <p><strong>Nama:</strong> {{ $pesanan->nama_penerima }}</p>
            <p><strong>Tanggal:</strong> {{ $pesanan->tanggal }}</p>
        </div>

        <!-- TABLE -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Barang</th>
                    <th>Ukuran</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($pesanan->pesanan_details as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->ukuran }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->harga) }}</td>
                        <td>Rp {{ number_format($item->subtotal) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- TOTAL -->
        <div class="text-right total">
            Total: Rp {{ number_format($pesanan->total_harga) }}
        </div>

        <!-- STATUS -->
        <div class="text-right status">
            Sudah Dibayar
        </div>

        <!-- FOOTER -->
        <div class="footer">
            Terima kasih sudah berbelanja di HelmKu <br>
            Barang akan segera dikirim
        </div>

    </div>

</body>

</html>