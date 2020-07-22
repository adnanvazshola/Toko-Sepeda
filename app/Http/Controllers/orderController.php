<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Order;
use App\Pembayaran;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function view($invoice)
    {
        $order = Order::with(['kecamatan.kota.provinsi', 'details', 'details.produk', 'pembayarans'])
            ->where('invoice', $invoice)->first();

            //return $order;
        return view('ecomm.viewOrder', compact('order'));
    }

    public function pembayaranForm()
    {
        return view('ecomm.pembayaran');
    }

    public function storePembayaran(Request $request)
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
        if ($order->subtotal != $request->amount) return redirect()->back()->with(['error' => 'Error, Pembayaran Harus Sama Dengan Tagihan']);

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

            return view('ecomm.dashboard');
        }

        return redirect()->back()->with(['error' => 'Error, Upload Bukti Transfer']);
    } catch(\Exception $e) {

        DB::rollback();

        return redirect()->back()->with(['error' => $e->getMessage()]);
    }
}
}
