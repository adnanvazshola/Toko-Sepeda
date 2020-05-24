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
	            'produk_foto' 	=> $produk->foto
	        ];
	    }
	    $cookie = cookie('ab-carts', json_encode($carts), 2880);
	    
	    return redirect()->back()->cookie($cookie);
	}

	public function listCart()
	{
    	//MENGAMBIL DATA DARI COOKIE
    	$carts = $this->getCarts();
	    //UBAH ARRAY MENJADI COLLECTION, KEMUDIAN GUNAKAN METHOD SUM UNTUK MENGHITUNG SUBTOTAL
    	$subtotal = collect($carts)->sum(function($q) {
	        return $q['qty'] * $q['produk_harga']; //SUBTOTAL TERDIRI DARI QTY * PRICE
    	});
    	//LOAD VIEW CART.BLADE.PHP DAN PASSING DATA CARTS DAN SUBTOTAL
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
	    //QUERY UNTUK MENGAMBIL SEMUA DATA PROPINSI
	    $provinsi = Provinsi::orderBy('created_at', 'DESC')->get();
	    $carts = $this->getCarts(); //MENGAMBIL DATA CART
	    //MENGHITUNG SUBTOTAL DARI KERANJANG BELANJA (CART)
	    $subtotal = collect($carts)->sum(function($q) {
	        return $q['qty'] * $q['produk_harga'];
	    });
	    //ME-LOAD VIEW CHECKOUT.BLADE.PHP DAN PASSING DATA PROVINCES, CARTS DAN SUBTOTAL
	    return view('ecomm.checkout', compact('provinsi', 'carts', 'subtotal'));
	}

	public function getKota()
	{
	    //QUERY UNTUK MENGAMBIL DATA KOTA / KABUPATEN BERDASARKAN provinsi_id
	    $kota = Kota::where('provinsi_id', request()->provinsi_id)->get();
	    //KEMBALIKAN DATANYA DALAM BENTUK JSON
	    return response()->json(['status' => 'success', 'data' => $kota]);
	}

	public function getKecamatan()
	{
	    //QUERY UNTUK MENGAMBIL DATA KECAMATAN BERDASARKAN kota_id
	    $kecamatan = Kecamatan::where('kota_id', request()->kota_id)->get();
	    //KEMUDIAN KEMBALIKAN DATANYA DALAM BENTUK JSON
	    return response()->json(['status' => 'success', 'data' => $kecamatan]);
	}

	public function processCheckout(Request $request)
	{
	    //VALIDASI DATANYA
	    $this->validate($request, [
	        'pelanggan_nama' => 'required|string|max:100',
	        'pelanggan_telephone' => 'required',
	        'email' => 'required|email',
	        'pelanggan_alamat' => 'required|string',
	        'provinsi_id' => 'required|exists:provinsis,id',
	        'kota_id' => 'required|exists:kotas,id',
	        'kecamatan_id' => 'required|exists:kecamatans,id'
	    ]);
	    DB::beginTransaction();
	    try {
	        $pelanggan = Pelanggan::where('email', $request->email)->first();
	        if (!auth()->check() && $pelanggan) {
	            return redirect()->back()->with(['error' => 'Silahkan Login Terlebih Dahulu']);
	        }
	        $carts = $this->getCarts();
	        $subtotal = collect($carts)->sum(function($q) {
	            return $q['qty'] * $q['produk_harga'];
	        });

	        $pelanggan = Pelanggan::create([
	            'nama' => $request->pelanggan_nama,
	            'email' => $request->email,
	            'telephone' => $request->pelanggan_telephone,
	            'alamat' => $request->pelanggan_alamat,
	            'kecamatan_id' => $request->kecamatan_id,
	            'status' => false
	        ]);

	        $order = Order::create([
	            'invoice' 				=> 'INV-' . time(),
	            'pelanggan_id' 			=> $pelanggan->id,
	            'pelanggan_nama' 		=> $pelanggan->nama,
	            'pelanggan_telephone' 	=> $request->pelanggan_telephone,
	            'pelanggan_alamat' 		=> $request->pelanggan_alamat,
	            'kecamatan_id' 			=> $request->kecamatan_id,
	            'subtotal' 				=> $subtotal,
	            'pembayaran' 			=> $request->pembayaran
	        ]);

	        foreach ($carts as $row) {
	            $produk = Produk::find($row['produk_id']);
	            DetailOrder::create([
	                'order_id' => $order->id,
	                'produk_id' => $row['produk_id'],
	                'harga' => $row['produk_harga'],
	                'jumlah' => $row['qty'],
	                'berat' => $produk->berat
	            ]);
	        }
	        
	        //TIDAK TERJADI ERROR, MAKA COMMIT DATANYA UNTUK MENINFORMASIKAN BAHWA DATA SUDAH FIX UNTUK DISIMPAN
	        DB::commit();

	        $carts = [];
	        //KOSONGKAN DATA KERANJANG DI COOKIE
	        $cookie = cookie('ab-carts', json_encode($carts), 2880);
	        //REDIRECT KE HALAMAN FINISH TRANSAKSI
	        return redirect(route('front.finish_checkout', $order->invoice))->cookie($cookie);
	    } catch (\Exception $e) {
	        //JIKA TERJADI ERROR, MAKA ROLLBACK DATANYA
	        DB::rollback();
	        //DAN KEMBALI KE FORM TRANSAKSI SERTA MENAMPILKAN ERROR
	        return redirect()->back()->with(['error' => $e->getMessage()]);
	    }
	}

	public function checkoutFinish($invoice)
	{
    	$order = Order::with(['kecamatan.kota'])->where('invoice', $invoice)->first();
    	
    	return view('ecomm.checkoutFinish', compact('order'));
	}
}