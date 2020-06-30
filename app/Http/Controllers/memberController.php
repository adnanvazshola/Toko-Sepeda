<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Pelanggan;

class memberController extends Controller
{
    public function index()
    {
        $member = Pelanggan::orderBy('nama', 'DESC')->paginate(20);
        if (request()->s != '') {
            $member = $member->where('judul', 'LIKE', '%' . request()->s . '%');
        }

        return view('member.index', compact('member', $member));
    }
}