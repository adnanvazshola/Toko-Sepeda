<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    protected $appends = ['status_label', 'ref_status_label', 'commission', 'total'];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }


public function getStatusLabelAttribute()
{
    if ($this->status == 0) {
        return '<span class="badge badge-secondary">Baru</span>';
    } elseif ($this->status == 1) {
        return '<span class="badge badge-primary">Dikonfirmasi</span>';
    } elseif ($this->status == 2) {
        return '<span class="badge badge-info">Proses</span>';
    } elseif ($this->status == 3) {
        return '<span class="badge badge-warning">Dikirim</span>';
    }
    return '<span class="badge badge-success">Selesai</span>';
}


    public function details()
    {
        return $this->hasMany(DetailOrder::class);
    }

    public function pembayarans()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function getTotalAttribute()
    {
        return $this->subtotal + $this->cost;
    }
}
