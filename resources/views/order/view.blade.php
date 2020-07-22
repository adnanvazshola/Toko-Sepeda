@extends('layout.admin')

@section('title')
    <title>Detail Pesanan</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Detail Pesanan</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                Detail pesanan
                                <div class="float-right">
                                    @if ($order->status == 1 && $order->pembayarans->status == 0)
                                        <a href="{{ route('orders.approve_payment', $order->invoice) }}" class="btn btn-primary btn-sm">Terima Pembayaran</a>
                                    @endif
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Detail Pelanggan</h4>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="30%">Nama Pelanggan</th>
                                            <td>{{ $order->pelanggan_nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>Telp</th>
                                            <td>{{ $order->pelanggan_telephone }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>{{ $order->pelanggan_alamat }} 
                                                {{ $order->pelanggan->kecamatan->nama }} - 
                                                {{ $order->pelanggan->kecamatan->kota->nama}}, 
                                                {{ $order->pelanggan->kecamatan->kota->provinsi->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>Order Status</th>
                                            <td>{!! $order->status_label !!}</td>
                                        </tr>
                                        @if ($order->status > 1)
                                        <tr>
                                            <th>Nomor Resi</th>
                                            <td>
                                                @if ($order->status == 2)
                                                <form action="{{ route('orders.shipping') }}" method="post">
                                                    @csrf
                                                    <div class="input-group">
                                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                        <input type="text" name="tracking_number" placeholder="Masukkan Nomor Resi" class="form-control" required>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-secondary" type="submit">Kirim</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                @else
                                                {{ $order->tracking_number }}
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h4>Detail Pembayaran</h4>
                                    @if ($order->status != 0)
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="30%">Nama Pengirim</th>
                                            <td>{{ $order->pembayarans->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Bank Tujuan</th>
                                            <td>{{ $order->pembayarans->transfer_to }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Transfer</th>
                                            <td>{{ $order->Pembayarans->transfer_date }}</td>
                                        </tr>
                                        <tr>
                                            <th>Bukti Pembayaran</th>
                                            <td><a target="_blank" href="{{ asset('storage/pembayaran/' . $order->pembayarans->proof) }}">Lihat</a></td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>{!! $order->pembayarans->status_label !!}</td>
                                        </tr>
                                    </table>
                                    @else
                                    <h5 class="text-center">Belum Konfirmasi Pembayaran</h5>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <h4>Detail Produk</h4>
                                    <table class="table table-borderd table-hover">
                                        <tr>
                                            <th>Produk</th>
                                            <th>Quantity</th>
                                            <th>Harga</th>
                                            <th>Berat</th>
                                            <th>Subtotal</th>
                                        </tr>
                                        @foreach ($order->details as $row)
                                        <tr>
                                            <td>{{ $row->produk->nama }}</td>
                                            <td>{{ $row->jumlah }}</td>
                                            <td>Rp {{ number_format($row->harga) }}</td>
                                            <td>{{ $row->weight }} gr</td>
                                            <td>Rp {{ $row->jumlah * $row->harga }}</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection