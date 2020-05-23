<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\User;

class Berita extends Model
{
    public function user()
	{
	    return $this->belongsTo(User::class);
	}

	protected $guarded = [];
}
