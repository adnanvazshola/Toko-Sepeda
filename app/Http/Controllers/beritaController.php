<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Berita;
use App\User;
use File;

class beritaController extends Controller
{
    public function index()
    {
        $berita = Berita::with('user')->orderBy('created_at', 'DESC')->paginate(10);
        if (request()->s != '') {
            $berita = $berita->where('judul', 'LIKE', '%' . request()->s . '%');
        }

        return view('berita.index', compact('berita', $berita));
    }

    public function create()
	{
    	$user 		= User::get();

    	return view('berita.tambah', compact('user'));
	}

	public function store(Request $request)
	{
	    $this->validate($request, [
	        'judul' 		=> 'required|string|max:100',
	        'user_id'		=> 'required|exists:users,id',
	        'isi'			=> 'required',
	        'foto' 			=> 'required|image|mimes:png,jpeg,jpg',
	    ]);
	    if ($request->hasFile('foto')) {
	        $file = $request->file('foto');
	        $filename = time() . Str::slug($request->judul) . '.' . $file->getClientOriginalExtension();
	        $file->storeAs('public/berita', $filename);

	        $berita = Berita::create([
	            'judul' 		=> $request->judul,
	            'slug' 			=> $request->judul,
	            'user_id'		=> $request->user_id,
	            'isi'			=> $request->isi,
	            'foto' 			=> $filename,
	        ]);
	        
	        return redirect(route('berita.index'))->with(['success' => 'Berita Berhasil Di Publish']);
	    }
	}

	public function destroy($id)
	{
    	$berita = Berita::find($id);
    	File::delete(storage_path('app/public/berita/' . $berita->foto));
	    $berita->delete();

    	return redirect(route('berita.index'))->with(['success' => 'Berita Sudah Dihapus']);
	}

	public function edit($id)
	{
    	$berita 	= Berita::find($id);
    	$user 		= User::orderBy('name', 'ASC')->get();
    	
    	return view('berita.edit', compact('berita', 'user'));
	}

	public function update(Request $request, $id)
	{
    $this->validate($request, [
	        'judul' 		=> 'required|string|max:100',
	        'user_id'		=> 'required|exists:users,id',
	        'isi'			=> 'required',
	        'foto' 			=> 'nullable|image|mimes:png,jpeg,jpg',
	    ]);
    $berita = Berita::find($id);
    $filename = $berita->foto;
  
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . Str::slug($request->judul) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/berita', $filename);
        File::delete(storage_path('app/public/berita/' . $berita->foto));
    }
    $berita->update([
	        'judul' 		=> $request->judul,
	        'slug' 			=> $request->judul,
	        'user_id'		=> $request->user_id,
	        'isi'			=> $request->isi,
	        'foto' 			=> $filename,
    ]);
    	return redirect(route('berita.index'))->with(['success' => 'Berita Telah Di Update']);
	}
}