<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pelanggan extends Authenticatable
{
	use Notifiable;
    protected $guarded = [];

    public function setPasswordAttribute($value)
	{
    	$this->attributes['password'] = bcrypt($value);
	}

	public function kecamatan()
	{
    	return $this->belongsTo(Kecamatan::class);
	}
}
