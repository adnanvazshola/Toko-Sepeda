@extends('layout.ecomm')
@section('title')
    <title>Order {{ $order->invoice }}</title>
@endsection

@section('content')
	<main class="ps-main">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="card">
                		<div class="card-header">
                    		<h4 class="card-title">Data Pelanggan</h4>
                		</div>
						<div class="card-body">
							<table>
                      			<tr>
                          			<td width="30%">Nama Lengkap</td>
                          			<td width="5%">:</td>
                          			<th>{{ $order->pelanggan_nama }}</th>
                      			</tr>
                      			<tr>
		                          	<td>No Telp</td>
		                          	<td>:</td>
		                          	<th>{{ $order->pelanggan_telephone }}</th>
		                      	</tr>
		                      	<tr>
		                          	<td>Alamat</td>
		                          	<td>:</td>
		                          	<th>{{ $order->pelanggan_alamat }}, 
		                          		{{ $order->kecamatan->nama }} 
		                          		{{ $order->kecamatan->kota->nama }}, 
		                          		{{ $order->kecamatan->kota->provinsi->nama }}</th>
		                      	</tr>
		                  	</table>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card">
                		<div class="card-header">
                    		<h4 class="card-title">
                        		Pembayaran
                        		@if ($order->status == 0)
                        			<a href="{{ url('member/pembayaran?invoice=' . $order->invoice) }}" class="btn btn-primary btn-sm float-right">Konfirmasi</a>
                        		@endif
                    		</h4>
                		</div>
						<div class="card-body">
                  			@if ($order->pembayaran)
								<table>
                     				<tr>
                          				<td width="30%">Nama Pengirim</td>
                          				<td width="5%"></td>
			                          	<td>{{ $order->pembayaran->name }}</td>
			                      	</tr>
			                      	<tr>
			                          	<td>Tanggal Transfer</td>
			                          	<td></td>
			                          	<td>{{ $order->pembayaran->transfer_date }}</td>
			                      	</tr>
			                      	<tr>
			                          	<td>Jumlah Transfer</td>
			                          	<td></td>
			                          	<td>Rp {{ number_format($order->pembayaran->amount) }}</td>
			                      	</tr>
			                      	<tr>
			                          	<td>Tujuan Transfer</td>
			                          	<td></td>
			                          	<td>{{ $order->pembayaran->transfer_to }}</td>
			                      	</tr>
			                      	<tr>
			                          	<td>Bukti Transfer</td>
			                          	<td></td>
			                          	<td>
			                              	<img src="{{ asset('storage/pembayaran/' . $order->pembayaran->proof) }}" width="50px" height="50px" alt="">
			                              	<a href="{{ asset('storage/pembayaran/' . $order->pembayaran->proof) }}" target="_blank">Lihat Detail</a>
			                          	</td>
			                      	</tr>
			                  	</table>
                  			@else
                  				<h4 class="text-center">Belum ada data pembayaran</h4>
                  			@endif
						</div>
					</div>
              	</div>
              	<div class="col-md-12 mt-4">
                  	<div class="card">
                      	<div class="card-header">
                          	<h4 class="card-title">Detail</h4>
                      	</div>
                      	<div class="card-body">
                          	<div class="table-responsive">
                              	<table class="table table-bordered table-hover">
                                  	<thead>
                                      	<tr>
                                          	<th>Nama Produk</th>
                                          	<th>Harga</th>
                                          	<th>Quantity</th>
                                          	<th>Berat</th>
                                      	</tr>
                                  	</thead>
                                  	<tbody>
                                      	@forelse ($order->details as $row)
                                      	<tr>
                                          	<td>{{ $row->produk->nama }}</td>
                                          	<td>{{ number_format($row->harga) }}</td>
                                          	<td>{{ $row->jumlah }} Item</td>
                                          	<td>{{ $row->weight }} gr</td>
                                      	</tr>
                                      	@empty
                                      	<tr>
                                          	<td colspan="4" class="text-center">Tidak ada data</td>
                                      	</tr>
                                      	@endforelse
                                  	</tbody>
                              	</table>
                          	</div>
                      	</div>
                  	</div>
              	</div>
			</div>
		</div>
	</main>
@endsection