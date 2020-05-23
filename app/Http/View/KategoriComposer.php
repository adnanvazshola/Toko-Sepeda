<?php

namespace App\Http\View;

use Illuminate\View\View;
use App\Kategori;

class KategoriComposer
{
    public function compose(View $view)
    {
        $kategori  = Kategori::with(['child'])->withCount(['child'])->getParent()->orderBy('nama', 'ASC')->get();
        $view->with('kategori', $kategori);
    }
}