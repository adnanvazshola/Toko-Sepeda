<?php

namespace App\Http\Controllers\ecomm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    	return view('ecomm.dashboard');
	}

	public function logout()
	{
    	auth()->guard('pelanggan')->logout();
    
    	return redirect(route('pelanggan.login'));
	}
}
