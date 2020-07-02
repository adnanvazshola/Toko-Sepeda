<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;

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


    	return view('ecomm.dashboard', compact('orders','order'));

    	// return view('ecomm.dashboard');
	}

	public function logout()
	{
    	auth()->guard('pelanggan')->logout();

    	return redirect(route('pelanggan.login'));
	}
    
    public function simpan(Request $request, $id)
	{

    $this->validate($request, [
	        'pelanggan_nama' 		=> 'required|string|max:100',
	        'pelanggan_telephone'		=> 'required|number',
	        'email'			    => 'required',
            'alamat' 			=> 'required|string|max:100',
            'tanggalLahir'      => 'required',
            'jenisKelamin'      => 'required',
            'kecamatan_id'      => 'required',
	    ]);
    $pelanggan = Pelanggan::find($id);

    $pelanggan->simpan([
	        'nama' 		    => $request->pelanggan_nama,
            'telephone'     => $request->pelanggan_telephone,
            'email'         => $request->email,
	        'alamat'		=> $request->pelanggan_alamat,
            'tanggalLahir'	=> $request->tgl_lahir,
            'jenisKelamin'  => $request->jenis_kelamin,
	        'kecamatan_id' 	=> $request->kecamatan,
		]);
		return redirect(route('pelanggan.dashboard'));
	}
}
