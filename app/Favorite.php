<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
	protected $guarded = [
		'id',
		'created_at',
		'updated_at',
	];

	/**
	 * Define relationship with the Produk
	 *
	 * @return void
	 */
	public function produk()
	{
		return $this->belongsTo('App\Models\Produk');
	}
}
