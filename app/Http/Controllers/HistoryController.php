<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\PesananDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // LIST RIWAYAT
    public function index()
    {
        $pesanans = Pesanan::where('user_id', Auth::id())
                    ->where('status','!=','keranjang')
                    ->get();

        return view('history.index', compact('pesanans'));
    }

    // DETAIL PESANAN
    public function detail($id)
    {
        $pesanan = Pesanan::where('id', $id)
                    ->where('user_id', Auth::id()) // 🔥 keamanan
                    ->first();

        if(!$pesanan){
            return redirect('history')->with('error','Data tidak ditemukan');
        }

        $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();

        return view('history.detail', compact('pesanan','pesanan_details'));
    }
}
