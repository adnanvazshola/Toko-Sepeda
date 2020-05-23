<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Produk;

class Kategori extends Model
{
	protected $fillable = ['nama', 'parent_id', 'slug'];

    public function parent()
	{
    	return $this->belongsTo(Kategori::class);
	}

	public function scopeGetParent($query)
	{
    	return $query->whereNull('parent_id');
	}

	public function setSlugAttribute($value)
	{
    	$this->attributes['slug'] = Str::slug($value);
	}

	public function getNameAttribute($value)
	{
	    return ucfirst($value);
	}

	public function child()
	{
    	return $this->hasMany(Kategori::class, 'parent_id');
	}

	public function produk()
	{
    	return $this->hasMany(Produk::class);
	}
}
