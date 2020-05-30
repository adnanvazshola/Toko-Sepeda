@extends('layout.ecomm')
@section('title')
	<title>Keranjang Belanja - Dw Ecommerce</title>
@endsection

@section('css')
	<link rel="stylesheet" href="{{ asset('css/checkoutFinish.css') }}">
@endsection

@section('content')
	<section class="order_details p_120">
		<div class="container">
			<div class="title_confirmation">
				<h3>Terima kasih, pesanan anda telah kami terima.</h3><br>
				<h5>Harap Konfirmasi pembayaran anda pada dashboard</h5>
			</div>
			<div class="row order_d_inner">
				<div class="col-lg-4">
					<div class="details_item">
						<h4>Informasi Pesanan</h4>
						<ul class="list">
							<li>
								<a href="#">
                  <span>Invoice</span> : {{ $order->invoice }}</a>
							</li>
							<li>
								<a href="#">
                  <span>Tanggal</span> : {{ $order->created_at }}</a>
							</li>
							<li>
								<a href="#">
                  <span>Total</span> : Rp {{ number_format($order->subtotal) }}</a>
							</li>
							<li>
								<a href="#">
                  <span>Metode pembayaran</span> : {{ $order->pembayaran }}</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="details_item">
						<h4>Informasi Pengiriman</h4>
						<ul class="list">
							<li>
								<a href="#">
                  <span>Alamat</span> : {{ $order->pelanggan_alamat }}</a>
							</li>
							<li>
								<a href="#">
                  <span>Kecamatan</span> : {{ $order->kecamatan->nama }}</a>
							</li>
							<li>
								<a href="#">
                  <span>Kota</span> : {{ $order->kecamatan->kota->nama }}</a>
							</li>
							<li>
								<a href="#">
									<span>Country</span> : Indonesia</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="details_item">
						<h4>Informasi Akun</h4>
						<ul class="list">
							<li>
								<a href="#">
                  <span>Email</span> : </a>
							</li>
							<li>
								<a href="#">
                  <span>Username</span> : {{ $order->pelanggan_nama }}</a>
							</li>
							<li>
								<a href="#">
                  <span>Password</span> :</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection