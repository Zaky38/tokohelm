<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\User;

class AdminController extends Controller
{
   public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

        if (strtolower(trim($user->role)) !== 'admin') {
            abort(403);
        }

        $barangs = Barang::all();

        return view('admin.dashboard', compact('barangs'));
    }
}