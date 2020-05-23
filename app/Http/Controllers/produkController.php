<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Produk;
use App\Kategori;
use App\Merk;
use App\Warna;
use File;
use App\Jobs\ProdukJob;

class produkController extends Controller
{
    public function index()
    {
        $produk = Produk::with(['kategori','warna','merk'])->orderBy('created_at', 'DESC');
        if (request()->s != '') {
            $produk = $produk->where('nama', 'LIKE', '%' . request()->s . '%');
        }
        $produk = $produk->paginate(10);

        return view('produk.index', compact('produk', $produk));
    }

    public function create()
	{
    	$merk 		= Merk::orderBy('nama', 'ASC')->get();
    	$kategoris 	= Kategori::orderBy('nama', 'ASC')->get();
    	$warna 		= Warna::orderBy('nama', 'ASC')->get();

    	return view('produk.tambah', compact('merk','kategoris','warna'));
	}

	public function store(Request $request)
	{
	    $this->validate($request, [
	        'nama' 			=> 'required|string|max:100',
	        'merk_id'		=> 'required|exists:merks,id',
	        'kategori_id' 	=> 'required|exists:kategoris,id',
	        'ukuran'		=> 'required',
	        'warna_id'		=> 'required|exists:warnas,id',
	        'stok'			=> 'required|integer',
	        'desc' 			=> 'required',
	        'harga' 		=> 'required|integer',
	        'berat' 		=> 'required|integer',
	        'foto' 			=> 'required|image|mimes:png,jpeg,jpg'
	    ]);
	    if ($request->hasFile('foto')) {
	        $file = $request->file('foto');
	        $filename = time() . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
	        $file->storeAs('public/produk', $filename);

	        $produk = Produk::create([
	            'nama' 			=> $request->nama,
	            'slug' 			=> $request->nama,
	            'merk_id'		=> $request->merk_id,
	            'kategori_id' 	=> $request->kategori_id,
	            'ukuran'		=> join(',', $request->ukuran),
	            'warna_id'		=> join(',', $request->warna_id),
	            'stok'			=> $request->stok,
	            'desc' 			=> $request->desc,
	            'harga' 		=> $request->harga,
	            'berat' 		=> $request->berat,
	            'foto' 			=> $filename,
	            'status' 		=> $request->status
	        ]);
	        
	        return redirect(route('produk.index'))->with(['success' => 'Produk Baru Ditambahkan']);
	    }
	}

	public function destroy($id)
	{
    	$produk = Produk::find($id);
    	File::delete(storage_path('app/public/produk/' . $produk->foto));
	    $produk->delete();

    	return redirect(route('produk.index'))->with(['success' => 'Produk Sudah Dihapus']);
	}

	public function uploadProdukMassal()
	{
    	$kategori = Kategori::orderBy('nama', 'DESC')->get();
    	return view('produk.massal', compact('kategori'));
	}

	public function produkUpload(Request $request)
	{
    	$this->validate($request, [
        	'kategori_id' => 'required|exists:kategoris,id',
        	'file' => 'required|mimes:xlsx'
    	]);

	    if ($request->hasFile('file')) {
        	$file = $request->file('file');
        	$filename = time() . '-produk.' . $file->getClientOriginalExtension();
        	$file->storeAs('public/uploads', $filename);
        	ProdukJob::dispatch($request->kategori_id, $filename);

        	return redirect()->back()->with(['success' => 'Upload Produk Dijadwalkan']);
    	}
	}

	public function edit($id)
	{
    	$produk = Produk::find($id);
    	$merk 		= Merk::orderBy('nama', 'ASC')->get();
    	$kategoris 	= Kategori::orderBy('nama', 'ASC')->get();
    	$warna 		= Warna::orderBy('nama', 'ASC')->get();
    	
    	return view('produk.edit', compact('produk', 'kategoris', 'merk', 'warna'));
	}

	public function update(Request $request, $id)
	{
    $this->validate($request, [
	        'nama' 			=> 'required|string|max:100',
	        'merk_id'		=> 'required|exists:merks,id',
	        'kategori_id' 	=> 'required|exists:kategoris,id',
	        'ukuran'		=> 'required',
	        'warna_id'		=> 'required|exists:warnas,id',
	        'stok'			=> 'required|integer',
	        'desc' 			=> 'required',
	        'harga' 		=> 'required|integer',
	        'berat' 		=> 'required|integer',
	        'foto' 			=> 'nullable|image|mimes:png,jpeg,jpg'
	    ]);
    $produk = Produk::find($id);
    $filename = $produk->foto;
  
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/produk', $filename);
        File::delete(storage_path('app/public/produk/' . $produk->foto));
    }
    $produk->update([
        'nama' 			=> $request->nama,
        'slug' 			=> $request->nama,
        'merk_id'		=> $request->merk_id,
        'kategori_id' 	=> $request->kategori_id,
        'ukuran'		=> join(',', $request->ukuran),
        'warna_id'		=> join(',', $request->warna_id),
        'stok'			=> $request->stok,
        'desc' 			=> $request->desc,
        'harga' 		=> $request->harga,
        'berat' 		=> $request->berat,
        'foto' 			=> $filename,
        'status' 		=> $request->status
    ]);
    	return redirect(route('produk.index'))->with(['success' => 'Data Produk Telah Di Update']);
	}
}