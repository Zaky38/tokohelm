<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PesanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // DETAIL BARANG
    public function index($id)
    {
        $barang = Barang::findOrFail($id);
        return view('pesan.index', compact('barang'));
    }

    // TAMBAH KE KERANJANG
    public function pesan(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $tanggal = Carbon::now();

        // VALIDASI STOK
        if($request->jumlah_pesan > $barang->quantity){
            return redirect('pesan/'.$id)->with('error','Jumlah melebihi stok');
        }

        // CEK PESANAN
        $pesanan = Pesanan::where('user_id', Auth::id())
                    ->where('status','keranjang')
                    ->first();

        if(!$pesanan){
            $pesanan = new Pesanan();
            $pesanan->user_id = Auth::id();
            $pesanan->kode_pesanan = 'ORD'.mt_rand(1000,9999);
            $pesanan->tanggal = $tanggal;

            $pesanan->nama_penerima = '-';
            $pesanan->no_hp = '-';
            $pesanan->alamat = '-';
            $pesanan->kurir = '-';
            $pesanan->ongkir = 0;
            $pesanan->metode_pembayaran = '-';
            $pesanan->status_pembayaran = 'belum';

            $pesanan->status = 'keranjang';
            $pesanan->total_harga = 0;

            $pesanan->save();
        }

        // DETAIL
        $detail = PesananDetail::where('pesanan_id',$pesanan->id)
                    ->where('barang_id',$barang->id)
                    ->first();

        if(!$detail){
            $detail = new PesananDetail();
            $detail->pesanan_id = $pesanan->id;
            $detail->barang_id = $barang->id;
            $detail->nama_barang = $barang->nama_barang;
            $detail->ukuran = $request->ukuran;
            $detail->quantity = $request->jumlah_pesan;
            $detail->harga = $barang->harga;
            $detail->subtotal = $barang->harga * $request->jumlah_pesan;
            $detail->save();

        } else {
            $detail->quantity += $request->jumlah_pesan;
            $detail->subtotal += $barang->harga * $request->jumlah_pesan;
            $detail->update();
        }

        // UPDATE TOTAL
        $pesanan->total_harga += $barang->harga * $request->jumlah_pesan;
        $pesanan->update();

        Alert::success('Berhasil', 'Barang masuk ke keranjang');
        return redirect('check-out');
    }

    // HALAMAN CHECKOUT
    public function check_out()
    {
        $pesanan = Pesanan::where('user_id',Auth::id())
                    ->where('status','keranjang')
                    ->first();

        $pesanan_details = [];

        if($pesanan){
            $pesanan_details = PesananDetail::where('pesanan_id',$pesanan->id)->get();
        }

        return view('pesan.check_out', compact('pesanan','pesanan_details'));
    }

    // HAPUS ITEM
    public function delete($id)
    {
        $detail = PesananDetail::findOrFail($id);
        $pesanan = Pesanan::findOrFail($detail->pesanan_id);

        $pesanan->total_harga -= $detail->subtotal;
        $pesanan->update();

        $detail->delete();

        return redirect('check-out')->with('success','Barang dihapus');
    }

    // KONFIRMASI CHECKOUT
    public function konfirmasi(Request $request)
    {
        $pesanan = Pesanan::where('user_id', Auth::id())
                    ->where('status', 'keranjang')
                    ->first();

        if(!$pesanan){
            return redirect('check-out')->with('error','Pesanan tidak ditemukan');
        }

        // VALIDASI
        $request->validate([
            'nama_penerima' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'kurir' => 'required',
            'ongkir' => 'required|numeric',
        ]);

        // HITUNG ULANG TOTAL
        $details = PesananDetail::where('pesanan_id', $pesanan->id)->get();

        $total = 0;
        foreach($details as $item){
            $total += $item->subtotal;
        }

        // SIMPAN
        $pesanan->nama_penerima = $request->nama_penerima;
        $pesanan->no_hp = $request->no_hp;
        $pesanan->alamat = $request->alamat;
        $pesanan->kurir = $request->kurir;
        $pesanan->ongkir = $request->ongkir;
        $pesanan->metode_pembayaran = $request->metode_pembayaran;

        // TOTAL + ONGKIR
        $pesanan->total_harga = $total + $request->ongkir;

        $pesanan->status = 'pending';
        $pesanan->status_pembayaran = 'belum_bayar';
        $pesanan->save();

        return redirect('pembayaran/'.$pesanan->id);
    }
}
