<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (trim(Auth::user()->role) === 'admin') {
            return redirect('/admin/dashboard');
        }
        $barangs = Barang::paginate(20);
        return view('dashboard', compact('barangs'));
    }
    public function dashboard()
{
    $barangs = Barang::all();

    // TOTAL PENJUALAN (tanpa pesanan batal)
    $totalPenjualan =
        Pesanan::where(
            'status',
            '!=',
            'dibatalkan'
        )->sum('total_harga');

    // PENJUALAN HARI INI
    $penjualanHariIni =
        Pesanan::whereDate(
            'created_at',
            Carbon::today()
        )
        ->where(
            'status',
            '!=',
            'dibatalkan'
        )
        ->sum('total_harga');

    // BARANG TERJUAL HARI INI
    $barangTerjualHariIni =
        PesananDetail::whereHas(
            'pesanan',
            function($q){

                $q->whereDate(
                    'created_at',
                    Carbon::today()
                )
                ->where(
                    'status',
                    '!=',
                    'dibatalkan'
                );

            }
        )
        ->sum('quantity');

    // BARANG DIBATALKAN HARI INI
    $barangDibatalkanHariIni =
        PesananDetail::whereHas(
            'pesanan',
            function($q){

                $q->whereDate(
                    'created_at',
                    Carbon::today()
                )
                ->where(
                    'status',
                    'dibatalkan'
                );

            }
        )
        ->sum('quantity');

    return view(
        'admin.dashboard',
        compact(
            'barangs',
            'totalPenjualan',
            'penjualanHariIni',
            'barangTerjualHariIni',
            'barangDibatalkanHariIni'
            )
        );
    }
}
