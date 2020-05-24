<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Merk;

class merkController extends Controller
{
    public function index()
    {
    	$merks = Merk::orderBy('nama')->paginate(5);

        return view('merk.index', compact('merks'));
    }

    public function store(Request $request)
	{
    	$this->validate($request, [
        	'nama' 		=> 'required|string|max:50|unique:merks',
        	'sales'		=> 'required|string|max:50',
        	'telephone'	=> 'required|numeric',
        	'email'		=> 'required'
    	]);
        $request->request->add(['slug' => $request->nama]);
    	Merk::create($request->except('_token'));

    	return redirect(route('merk.index'))->with(['success' => 'merk berhasil di tambah']);
	}

    public function edit($id)
    {
        $merk = Merk::find($id);
        $merks = Merk::orderBy('nama')->paginate(5);
      
        return view('merk.edit', compact('merk','merks'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' 		=> 'required|string|max:50|unique:merks,nama,' . $id,
            'sales'		=> 'required|string|max:50',
        	'telephone'	=> 'required|max:13',
        	'email'		=> 'required'
        ]);
        $merk = Merk::find($id);
        $merk->update([
            'nama' 		=> $request->nama,
            'slug'      => $request->nama,
            'sales' 	=> $request->sales,
            'telephone'	=> $request->telephone,
            'email' 	=> $request->email,
        ]);
      
        return redirect(route('merk.index'))->with(['success' => 'merk telah di update']);
    }

    public function destroy($id)
    {
        $merk = Merk::withCount(['child'])->find($id);
        if ($merk->child_count == 0) {
            $merk->delete();
            return redirect(route('merk.index'))->with(['success' => 'merk telah di hapus']);
        }
        return redirect(route('merk.index'))->with(['error' => 'masih ada stok produk pada merk ini']);
    }
}
