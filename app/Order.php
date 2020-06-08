<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}
