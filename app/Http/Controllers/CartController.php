<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Produk;
use App\Provinsi;
use App\Kota;
use App\Kecamatan;
use App\Pelanggan;
use App\Order;
use App\DetailOrder;
use DB;
use App\Mail\PelangganRegisterMail;
use Mail;
use Cookie;
use GuzzleHttp\Client;

class CartController extends Controller
{
	private function getCarts()
	{
    	$carts = json_decode(request()->cookie('ab-carts'), true);
    	$carts = $carts != '' ? $carts:[];

    	return $carts;
	}

    public function addToCart(Request $request)
	{
	    $this->validate($request, [
	        'produk_id' => 'required|exists:produks,id',
	        'ukuran'	=> 'required',
	        'qty' 		=> 'required|integer',
	        'catatan'	=> 'nullable',
	    ]);
	    $carts = $this->getCarts();
	    if ($carts && array_key_exists($request->produk_id, $carts)) {
	        $carts[$request->produk_id]['qty'] += $request->qty;
	    } else {
	        $produk = Produk::find($request->produk_id);
	        $carts[$request->produk_id] = [
	            'qty' 			=> $request->qty,
	            'ukuran'		=> $request->ukuran,
	            'catatan'		=> $request->catatan,
	            'produk_id' 	=> $produk->id,
	            'produk_nama' 	=> $produk->nama,
	            'produk_harga' 	=> $produk->harga,
	            'produk_foto' 	=> $produk->foto,
	            'weight' 		=> $produk->weight
	        ];
	    }
	    $cookie = cookie('ab-carts', json_encode($carts), 2880);
	    
	    return redirect()->back()->with(['success' => 'barang berhasil di tambah'])->cookie($cookie);
	}

	public function listCart()
	{
    	$carts = $this->getCarts();
    	$subtotal = collect($carts)->sum(function($q) {
	        return $q['qty'] * $q['produk_harga'];
    	});
    	return view('ecomm.cart', compact('carts', 'subtotal'));
	}

	public function updateCart(Request $request)
	{
	    $carts = $this->getCarts();
	    foreach ($request->produk_id as $key => $row) {
	        if ($request->qty[$key] == 0) {
	            unset($carts[$row]);
	        } else {
	            $carts[$row]['qty'] = $request->qty[$key];
	        }
	    }
	    $cookie = cookie('ab-carts', json_encode($carts), 2880);

	    return redirect()->back()->cookie($cookie);
	}

	public function checkout()
	{
	    $provinsi = Provinsi::orderBy('created_at', 'DESC')->get();
	    $carts = $this->getCarts();
	    $subtotal = collect($carts)->sum(function($q) {
	        return $q['qty'] * $q['produk_harga'];
	    });
	    $berat = collect($carts)->sum(function($q) {
        	return $q['qty'] * $q['weight'];
    	});

	    return view('ecomm.checkout', compact('provinsi', 'carts', 'subtotal', 'berat'));
	}

	public function getKota()
	{
	    $kota = Kota::where('provinsi_id', request()->provinsi_id)->get();

	    return response()->json(['status' => 'success', 'data' => $kota]);
	}

	public function getKecamatan()
	{
	    $kecamatan = Kecamatan::where('kota_id', request()->kota_id)->get();
	    return response()->json(['status' => 'success', 'data' => $kecamatan]);
	}

	public function processCheckout(Request $request)
	{
	    $this->validate($request, [
	        'pelanggan_nama'		=> 'required|string|max:100',
	        'pelanggan_telephone' 	=> 'required',
	        'email' 				=> 'required|email',
	        'pelanggan_alamat' 		=> 'required|string',
	        'provinsi_id' 			=> 'required|exists:provinsis,id',
	        'kota_id' 				=> 'required|exists:kotas,id',
	        'kecamatan_id'			=> 'required|exists:kecamatans,id',
	        'courier' 				=> 'required'
	    ]);
	    DB::beginTransaction();
	    try {
	        $pelanggan = Pelanggan::where('email', $request->email)->first();
	        if (!auth()->guard('pelanggan')->check() && $pelanggan) {
	            return redirect()->back()->with(['error' => 'Silahkan Login Terlebih Dahulu']);
	        }

	        $carts = $this->getCarts();
	        $subtotal = collect($carts)->sum(function($q) {
	            return $q['qty'] * $q['produk_harga'];
	        });

	        if (!auth()->guard('pelanggan')->check()) {
		        $password = Str::random(8);
		        $pelanggan = Pelanggan::create([
		            'nama' 			=> $request->pelanggan_nama,
		            'email' 		=> $request->email,
		            'password'		=> $password,
		            'telephone' 	=> $request->pelanggan_telephone,
		            'alamat' 		=> $request->pelanggan_alamat,
		            'kecamatan_id' 	=> $request->kecamatan_id,
		            'activate_token'=> Str::random(30),
		            'status' 		=> false
		        ]);
		    }

	        $shipping = explode('-', $request->courier);
	        $order = Order::create([
	            'invoice' 				=> 'INV-' . time(),
	            'pelanggan_id' 			=> $pelanggan->id,
	            'pelanggan_nama' 		=> $pelanggan->nama,
	            'pelanggan_telephone' 	=> $request->pelanggan_telephone,
	            'pelanggan_alamat' 		=> $request->pelanggan_alamat,
	            'kecamatan_id' 			=> $request->kecamatan_id,
	            'subtotal' 				=> $subtotal,
	            'pembayaran' 			=> $request->pembayaran,
	            'cost' 					=> $shipping[2],
    			'shipping' 				=> $shipping[0] . '-' . $shipping[1],
	        ]);

	        foreach ($carts as $row) {
	            $produk = Produk::find($row['produk_id']);
	            DetailOrder::create([
	                'order_id' 	=> $order->id,
	                'produk_id'	=> $row['produk_id'],
	                'harga' 	=> $row['produk_harga'],
	                'ukuran'	=> $row['ukuran'],
	                'jumlah' 	=> $row['qty'],
	                'weight' 	=> $row['weight']
	            ]);
	        }

	        DB::commit();

	        $carts = [];
	        $cookie = cookie('ab-carts', json_encode($carts), 2880);
	        if (!auth()->guard('pelanggan')->check()) {
		        Mail::to($request->email)->send(new PelangganRegisterMail($pelanggan, $password));
		    }

	        return redirect(route('front.finish_checkout', $order->invoice))->cookie($cookie);
	    } catch (\Exception $e) {
	        DB::rollback();
	        return redirect()->back()->with(['error' => $e->getMessage()]);
	    }
	}

	public function checkoutFinish($invoice)
	{
    	$order = Order::with(['kecamatan.kota'])->where('invoice', $invoice)->first();
    	
    	return view('ecomm.checkoutFinish', compact('order'));
	}

	//API

	public function getCourier(Request $request)
	{
	    $this->validate($request, [
	        'destination' => 'required',
	        'weight' => 'required|integer'
	    ]);

	    $url = 'https://ruangapi.com/api/v1/shipping';
	    $client = new Client();
	    $response = $client->request('POST', $url, [
	        'headers' => [
	            'Authorization' => 'iBrTqdLDJlg0HLZ4aqws2h8oKaEgIRZlJI8wTCXZ'
	        ],
	        'form_params' => [
	            'origin' 		=> 22,
	            'destination' 	=> $request->destination,
	            'weight' 		=> $request->weight,
	            'courier' 		=> 'jne,jnt'
	        ]
	    ]);

	    $body = json_decode($response->getBody(), true);
	    return $body;
	}
}