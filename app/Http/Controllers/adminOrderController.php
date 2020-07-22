<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Mail\OrderMail;
use Mail;

class adminOrderController extends Controller
{
    public function index()
	{
	    $orders = Order::with(['pelanggan.kecamatan.kota.provinsi'])
	        ->orderBy('created_at', 'DESC');
	    if (request()->q != '') {
	        $orders = $orders->where(function($q) {
	            $q->where('pelanggan_nama', 'LIKE', '%' . request()->q . '%')
	            ->orWhere('invoice', 'LIKE', '%' . request()->q . '%')
	            ->orWhere('pelanggan_alamat', 'LIKE', '%' . request()->q . '%');
	        });
	    }
	    if (request()->status != '') {
	        $orders = $orders->where('status', request()->status);
	    }
	    $orders = $orders->paginate(10);
	    return view('order.index', compact('orders'));
	}

	public function destroy($id)
	{
    	$order = Order::find($id);
    	$order->details()->delete();
    	$order->pembayarans()->delete();
    	$order->delete();
    	return redirect(route('orders.index'));
	}

	public function view($invoice)
	{
    	$order = Order::with(['pelanggan.kecamatan.kota.provinsi', 'pembayarans', 'details.produk'])->where('invoice', $invoice)->first();
    	return view('order.view', compact('order'));
	}

	public function acceptPayment($invoice)
	{
    	$order = Order::with(['pembayarans'])->where('invoice', $invoice)->first();
    	$order->pembayarans()->update(['status' => 1]);
    	$order->update(['status' => 2]);
    	return redirect(route('orders.view', $order->invoice));
	}

	public function shippingOrder(Request $request)
	{
	    $order = Order::with(['pelanggan'])->find($request->order_id);
	    $order->update(['tracking_number' => $request->tracking_number, 'status' => 3]);
	    Mail::to($order->pelanggan->email)->send(new OrderMail($order));
	    return redirect()->back();
	}
}
