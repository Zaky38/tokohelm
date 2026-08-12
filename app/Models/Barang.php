<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'gambar',
        'nama_barang',
        'rating',
        'deskripsi_singkat',
        'ukuran',
        'quantity',
        'harga'
    ];

    public function pesanan_detail() 
    {
        return $this->hasMany('App\Models\PesananDetail','barang_id', 'id');
    }
}