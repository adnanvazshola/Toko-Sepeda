<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warna extends Model
{
    public function merk()
	{
    	return $this->hasMany(Merk::class);
	}
}
