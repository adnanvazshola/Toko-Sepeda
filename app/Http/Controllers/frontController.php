<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Berita;
use App\Kategori;
use App\Merk;
use App\Pelanggan;

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

    public function verifikasiPelanggan($token)
    {
        $pelanggan = Pelanggan::where('activate_token', $token)->first();
        if ($pelanggan) {
            $pelanggan->update([
                'activate_token' => null,
                'status' => 1
            ]);
            return redirect(route('pelanggan.login'))->with(['success' => 'Verifikasi Berhasil, Silahkan Login']);
        }
    
        return redirect(route('pelanggan.login'))->with(['error' => 'Invalid Verifikasi Token']);
    }

    public function blog()
    {
        $blog        = Berita::with('user')->orderBy('created_at', 'DESC')->paginate(5);
    
        return view('ecomm.blog', compact('blog'));
    }

    public function detailBlog($slug)
    {
        $blog = Berita::with(['user'])->where('slug', $slug)->first();
        //$blok = Berita::with(['user'])->where('slug' != $slug)->paginate(5);
        $blok        = Berita::with('user')->orderBy('created_at', 'DESC')->paginate(5);

        return view('ecomm.detailBlog', compact('blog','blok'));
    }
}