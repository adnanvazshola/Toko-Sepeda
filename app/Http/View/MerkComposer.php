<?php

namespace App\Http\View;

use Illuminate\View\View;
use App\Merk;

class MerkComposer
{
    public function compose(View $view)
    {
        $merk      = Merk::orderBy('nama','ASC')->get();
        $view->with('merk', $merk);
    }
}