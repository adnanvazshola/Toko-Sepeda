<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;

class kategoriController extends Controller
{
    public function index()
    {
    	$kategori = Kategori::with(['parent'])->orderBy('nama', 'DESC')->paginate(10);
        $parent = Kategori::getParent()->orderBy('nama', 'ASC')->get();
      
        return view('kategori.index', compact('kategori', 'parent'));
    }

    public function store(Request $request)
	{
    	$this->validate($request, [
        	'nama' => 'required|string|max:50|unique:kategoris'
    	]);
    	$request->request->add(['slug' => $request->nama]);
    	Kategori::create($request->except('_token'));

    	return redirect(route('kategori.index'))->with(['success' => 'Kategori berhasil di tambah']);
	}

    public function edit($id)
    {
        $kategori = Kategori::find($id);
        $parent = Kategori::getParent()->orderBy('nama', 'ASC')->get();
      
        return view('kategori.edit', compact('kategori', 'parent'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:50|unique:kategoris,nama,' . $id
        ]);
        $kategori = Kategori::find($id);
        $kategori->update([
            'nama'      => $request->nama,
            'slug'      => $request->nama,
            'parent_id' => $request->parent_id
        ]);
      
        return redirect(route('kategori.index'))->with(['success' => 'Kategori telah di update']);
    }
    
    public function destroy($id)
    {
        $kategori = Kategori::withCount(['child', 'produk'])->find($id);
        if ($kategori->child_count == 0 && $kategori->produk_count == 0) {
            $kategori->delete();
            return redirect(route('kategori.index'))->with(['success' => 'Kategori telah di hapus']);
        }
        return redirect(route('kategori.index'))->with(['error' => 'Kategori Ini Memiliki Anak Kategori']);
    }
}