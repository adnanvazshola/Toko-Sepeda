<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use DataTables;

class kategoriController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kategori::with(['parent'])->orderBy('nama')->orderBy("nama")->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editKategori">Edit</a>';
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteKategori">Delete</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $parent = Kategori::getParent()->orderBy('nama', 'ASC')->get();
        return view('kategori.index', compact('parent'));
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
        Kategori::find($id)->delete();
     
        return response()->json(['success'=>'Kategori dihapus.']);
    }
    
}