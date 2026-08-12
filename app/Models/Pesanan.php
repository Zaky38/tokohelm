<?php

namespace App\Models;
use App\Models\PesananDetail;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    public function user()
	{
	      return $this->belongsTo('App\Models\User','user_id', 'id');
	}

	public function pesanan_detail()
	{
	     return $this->hasMany('App\Models\PesananDetail','pesanan_id', 'id');
	}

    public function pesanan_details()
    {
        return $this->hasMany(PesananDetail::class, 'pesanan_id', 'id');
    }
}
