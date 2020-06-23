<?php

namespace App\Http\Controllers\Ecomm;

use App\Http\Controllers\Controller;
use App\Order;
use App\Pembayaran;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('pelanggan_id', auth()->guard('pelanggan')->user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('ecomm.orders.index', compact('orders'));
    }

    public function view($invoice)
    {
        $order = Order::with(['kecamatan.kota.provinsi', 'details', 'details.produk', 'pembayaran'])
            ->where('invoice', $invoice)->first();
        return view('ecomm.orders.view', compact('order'));
    }

    public function pembayaranForm()
    {
        return view('ecomm.pembayaran');
    }

    public function tokoPembayaran(Request $request)
    {

    $this->validate($request, [
        'invoice' => 'required|exists:orders,invoice',
        'name' => 'required|string',
        'transfer_to' => 'required|string',
        'transfer_date' => 'required',
        'amount' => 'required|integer',
        'proof' => 'required|image|mimes:jpg,png,jpeg'
    ]);


    DB::beginTransaction();
    try {

        $order = Order::where('invoice', $request->invoice)->first();

        if ($order->status == 0 && $request->hasFile('proof')) {

            $file = $request->file('proof');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/pembayaran', $filename);


            Pembayaran::create([
                'order_id' => $order->id,
                'name' => $request->name,
                'transfer_to' => $request->transfer_to,
                'transfer_date' => Carbon::parse($request->transfer_date)->format('Y-m-d'),
                'amount' => $request->amount,
                'proof' => $filename,
                'status' => false
            ]);

            $order->update(['status' => 1]);

            DB::commit();

            return redirect()->back()->with(['success' => 'Pesanan Dikonfirmasi']);
        }

        return redirect()->back()->with(['error' => 'Error, Upload Bukti Transfer']);
    } catch(\Exception $e) {

        DB::rollback();

        return redirect()->back()->with(['error' => $e->getMessage()]);
    }
}
}
