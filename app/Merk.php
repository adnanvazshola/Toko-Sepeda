<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Produk;

class Merk extends Model
{
    protected $fillable = ['nama', 'sales', 'telephone', 'email'];

	public function child()
	{
    	return $this->hasMany(produk::class, 'merk_id');
	}

	public function produk()
	{
    	return $this->hasMany(Produk::class);
	}
}
