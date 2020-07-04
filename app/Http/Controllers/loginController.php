<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Provinsi;

class loginController extends Controller
{
    public function loginForm()
    {
    	if (auth()->guard('pelanggan')->check()) return redirect(route('pelanggan.dashboard'));
        return view('ecomm.login');
    }

    public function login(Request $request)
	{
	    $this->validate($request, [
	        'email' => 'required|email|exists:pelanggans,email',
	        'password' => 'required|string'
	    ]);

	    $auth = $request->only('email', 'password');
	    $auth['status'] = 1;

	    if (auth()->guard('pelanggan')->attempt($auth)) {
	        return redirect()->intended(route('pelanggan.dashboard'));
	    }

	    return redirect()->back()->with(['error' => 'Email / Password Salah']);
	}

	public function dashboard()
	{
		$orders = Order::selectRaw('
			COALESCE(sum(CASE WHEN status = 0 THEN subtotal END), 0) as ditunda,
        	COALESCE(count(CASE WHEN status = 3 THEN subtotal END), 0) as dikirim,
        	COALESCE(count(CASE WHEN status = 4 THEN subtotal END), 0) as selesaiOrder')
        		->where('pelanggan_id', auth()->guard('pelanggan')->user()->id)->get();
        $order = Order::where('pelanggan_id', auth()->guard('pelanggan')->user()->id)->orderBy('created_at', 'DESC')->paginate(10);
    	$member = auth()->guard('pelanggan')->user()->load('kecamatan');
    	$provinsi = Provinsi::orderBy('nama', 'ASC')->get();

    	return view('ecomm.dashboard', compact('orders','order','member','provinsi'));
	}

	public function logout()
	{
    	auth()->guard('pelanggan')->logout();

    	return redirect(route('pelanggan.login'));
	}
    
	public function updateData()
	{
		$member 	= auth()->guard('pelanggan')->user()->load('kecamatan');
    	$provinsi 	= Provinsi::orderBy('nama', 'ASC')->get();
    
    	return view('ecomm.editPelanggan', compact('member', 'provinsi'));
	}

    public function simpan(Request $request, $id)
	{
		//VALIDASI DATA YANG DIKIRIM
	    $this->validate($request, [
	    	'foto'			=> 'nullable|image|mimes:png,jpeg,jpg',
	        'nama' 			=> 'required|string|max:100',
	        'telephone' 	=> 'required|max:13',
	        'alamat' 		=> 'required|string',
	        'kecamatan_id' 	=> 'required|exists:kecamatans,id',
	        'password' 		=> 'nullable|string|min:8'
	    ]);
	    if ($request->hasFile('foto')) {
	        $file = $request->file('foto');
	        $filename = time() . Str::nama($request->nama) . '.' . $file->getClientOriginalExtension();
	        $file->storeAs('public/member', $filename);

		    //AMBIL DATA CUSTOMER YANG SEDANG LOGIN
		    $user = auth()->guard('pelanggan')->user();
		    //AMBIL DATA YANG DIKIRIM DARI FORM
		    //TAPI HANYA 4 COLUMN SAJA SESUAI YANG ADA DI BAWAH
		    $data = $request->only('nama', 'telephone', 'alamat', 'kecamatan_id');
		    //ADAPUN PASSWORD KITA CEK DULU, JIKA TIDAK KOSONG
		    if ($request->password != '') {
		        //MAKA TAMBAHKAN KE DALAM ARRAY
		        $data['password'] = $request->password;
		    }
		    //TERUS UPDATE DATANYA
	    	$user->update($data);
	    	//DAN REDIRECT KEMBALI DENGAN MENGIRIMKAN PESAN BERHASIL
	    	return view('ecomm.dashboard')->with(['success' => 'Profil berhasil diperbaharui']);
		}
	}
}
