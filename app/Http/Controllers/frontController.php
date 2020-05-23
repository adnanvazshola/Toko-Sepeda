<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Berita;
use App\Kategori;
use App\Merk;

class frontController extends Controller
{
    public function index()
	{
    	$produkbaru = Produk::with(['kategori','warna','merk'])->orderBy('created_at', 'DESC')->paginate(6);
    	$berita = Berita::orderBy('created_at','DESC')->paginate(3);
        $kategori  = Kategori::where( 'parent_id', '!=' ,'null')->orderBy('nama', 'ASC')->get();

    	return view('ecomm.index', compact('produkbaru','berita','kategori'));
	}

	public function produk()
	{
    	$produk        = Produk::with('merk')->orderBy('created_at', 'DESC')->paginate(18);
    	//$kategori    = Kategori::with(['child'])->withCount(['child'])->getParent()->orderBy('nama', 'ASC')->get();
        //$merk         = Merk::orderBy('nama','ASC')->get();
    
    	return view('ecomm.produk', compact('produk'));
	}

    public function kategoriProduk($slug)
    {
        $produk     = Kategori::where('slug', $slug)->first()->produk()->orderBy('created_at', 'DESC')->paginate(18);
        $merk       = Merk::orderBy('nama','ASC')->get();
    
        return view('ecomm.produk', compact('produk','merk'));
    }

    public function merkProduk($slug)
    {
        $produk     = Merk::where('slug', $slug)->first()->produk()->orderBy('created_at', 'DESC')->paginate(18);
        $kategori   = Kategori::with(['child'])->withCount(['child'])->getParent()->orderBy('nama', 'ASC')->get();
    
        return view('ecomm.produk', compact('produk','kategori'));
    }

    public function detailProduk($slug)
    {
        $produk = Produk::with(['kategori','merk','warna'])->where('slug', $slug)->first();

        return view('ecomm.detailProduk', compact('produk'));
    }
}