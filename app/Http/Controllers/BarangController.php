<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('admin.barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('admin.barang.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        // upload gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $nama);
            $data['gambar'] = $nama;
        }

        Barang::create($data);

        return redirect('/admin/barang')->with('success', 'Berhasil tambah!');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('admin.barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $data = $request->except(['_token', '_method']);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $nama);
            $data['gambar'] = $nama;
        }

        $barang->update($data);

        return redirect('/admin/barang');
    }

    public function destroy($id)
    {
        Barang::destroy($id);
        return back();
    }

    // public function __construct()
    // {
    // // WAJIB: pastikan user login dulu
    // $this->middleware('auth');

    // // Baru cek role
    // $this->middleware(function ($request, $next) {

    //     $user = Auth::user();

    //     if ($user->role !== 'admin') {
    //         abort(403);
    //     }

    //     return $next($request);
    // });
    // }
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {

            return $next($request);
        });
    }
}
