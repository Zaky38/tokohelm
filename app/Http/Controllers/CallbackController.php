<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Barang;
use Midtrans\Notification;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    public function receive(Request $request)
    {
        $notif = new Notification();

        $transaction = $notif->transaction_status;
        $order_id = $notif->order_id;
        $payment_type = $notif->payment_type;

        $pesanan = Pesanan::where('kode_pesanan', $order_id)->first();

        if(!$pesanan){
            return response()->json([
                'message' => 'Pesanan tidak ditemukan'
            ]);
        }

        // PEMBAYARAN BERHASIL
        if($transaction == 'settlement' || $transaction == 'capture'){

            $pesanan->status_pembayaran = 'sudah_bayar';
            $pesanan->status = 'diproses';
            $pesanan->metode_pembayaran = $payment_type;

            $pesanan->save();

            // KURANGI STOK
            foreach($pesanan->pesanan_details as $detail){

                $barang = Barang::find($detail->barang_id);

                if($barang){
                    $barang->quantity -= $detail->quantity;
                    $barang->save();
                }
            }

        }

        // GAGAL / EXPIRE
        else if($transaction == 'expire' || $transaction == 'cancel'){

            $pesanan->status_pembayaran = 'gagal';
            $pesanan->status = 'dibatalkan';

            $pesanan->save();

        }

        return response()->json([
            'success' => true
        ]);
    }
}