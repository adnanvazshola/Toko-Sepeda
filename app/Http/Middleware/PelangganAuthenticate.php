<?php

namespace App\Http\Middleware;

use Closure;

class PelangganAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //JADI KITA CEK, JIKA GUARD CUSTOMER BELUM LOGIN
        if (!auth()->guard('pelanggan')->check()) {
            //MAKA REDIRECT KE HALAMAN LOGIN
            return redirect(route('pelanggan.login'));
        }
        //JIKA SUDAH MAKA REQUEST YANG DIMINTA AKAN DISEDIAKAN
        return $next($request);
    }
}
