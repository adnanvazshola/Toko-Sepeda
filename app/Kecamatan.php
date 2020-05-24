<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }
}
