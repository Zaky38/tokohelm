<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Barang;
use App\Models\PesananDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function pembayaran($id)
    {
        $pesanan = Pesanan::find($id);

        return view('pembayaran', compact('pesanan'));
    }

    public function konfirmasiPembayaran(Request $request, $id)
{
    $request->validate([
        'bukti_transfer' => 'required|image'
    ]);

    $pesanan = Pesanan::with('pesanan_details')->findOrFail($id);

// CEGAH DOUBLE KLIK
if($pesanan->status_pembayaran == 'sudah_bayar'){
    return redirect('history')
        ->with(
            'error',
            'Pesanan sudah dibayar'
        );
}

    // UPLOAD BUKTI
    $file = $request->file('bukti_transfer');

    $namaFile =
        time().'_'.$file->getClientOriginalName();

    $file->move(
        public_path('bukti_transfer'),
        $namaFile
    );

    $pesanan->bukti_transfer =
        $namaFile;

    // KURANGI STOK
    foreach($pesanan->pesanan_details as $detail){

        $barang =
            Barang::find($detail->barang_id);

        if($barang){

            $barang->quantity -=
                $detail->quantity;

            if($barang->quantity < 0){
                $barang->quantity = 0;
            }

            $barang->save();
        }
    }

    $pesanan->status_pembayaran =
        'sudah_bayar';

    $pesanan->status =
        'diproses';

    $pesanan->save();

    return redirect('history')
        ->with(
            'success',
            'Bukti transfer berhasil dikirim'
        );
    }

    public function struk($id)
    {
        $pesanan = Pesanan::with('pesanan_details')->find($id);

        $pdf = Pdf::loadView('struk', compact('pesanan'));

        return $pdf->download('struk.pdf');
    }

    public function admin()
    {
        $pesanans = Pesanan::where('status', '!=', 'keranjang')
                    ->latest()
                    ->get();

        return view('admin.pesanan.index', compact('pesanans'));
    }

    public function detailAdmin($id)
    {
    $pesanan =
    Pesanan::with(
        'pesanan_details.barang'
    )->findOrFail($id);

    return view(
        'admin.pesanan.detail',
        compact('pesanan')
        );
    }

    public function kirim($id)
{
    $pesanan =
        Pesanan::findOrFail($id);

    // HANYA BOLEH KIRIM
    // JIKA STATUS DIPROSES
    if(
        $pesanan->status
        != 'diproses'
    ){
        return redirect(
            '/admin/pesanan'
        )->with(
            'error',
            'Pesanan tidak bisa dikirim'
        );
    }

    $pesanan->status =
        'dikirim';

    $pesanan->save();

    return redirect(
        '/admin/pesanan'
    )->with(
        'success',
        'Pesanan berhasil dikirim'
    );
}

    public function batal($id)
{
    $pesanan = Pesanan::with(
        'pesanan_details'
    )->findOrFail($id);

    // CEGAH BATAL JIKA SUDAH FINAL
    if(
        in_array(
            $pesanan->status,
            ['dibatalkan', 'dikirim']
        )
    ){
        return redirect(
            '/admin/pesanan'
        )->with(
            'error',
            'Pesanan tidak bisa dibatalkan lagi'
        );
    }

    if(
        $pesanan->status_pembayaran
        == 'sudah_bayar'
    ){

        foreach(
            $pesanan->pesanan_details
            as $detail
        ){

            $barang =
                Barang::find(
                    $detail->barang_id
                );

            if($barang){

                $barang->quantity +=
                    $detail->quantity;

                $barang->save();
            }
        }

    }

    $pesanan->status =
        'dibatalkan';

    $pesanan->status_pembayaran =
        'ditolak';

    $pesanan->save();

    return redirect(
        '/admin/pesanan'
    )->with(
        'success',
        'Pesanan berhasil dibatalkan'
    );
    }
}