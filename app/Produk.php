<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Kategori;
use App\Merk;
use App\Warna;

class Produk extends Model
{
    public function getStatusLabelAttribute()
	{
	    if ($this->status == 0) {
	        return '<span class="badge badge-secondary">Draft</span>';
	    }
	    return '<span class="badge badge-success">Aktif</span>';
	}

	public function kategori()
	{
	    return $this->belongsTo(Kategori::class);
	}

	public function merk()
	{
		return $this->belongsTo(Merk::class);
	}

	public function warna()
	{
		return $this->belongsTo(Warna::class);
	}

	protected $guarded = [];

	public function setSlugAttribute($value)
	{
	    $this->attributes['slug'] = Str::slug($value); 
	}
}
