<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggunaController extends Controller
{
    public function index()
    {
    	// mengambil data dari table Pengguna
    	$pengguna = DB::table('pengguna')->get();

    	// mengirim data pengguna ke view index
    	return view('index',['pengguna' => $pengguna]);

    }
}
