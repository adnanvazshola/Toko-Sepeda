@extends('layout.ecomm')
@section('title')
	<title>Pemesanan Sukses</title>
@endsection

@section('css')
	<link rel="stylesheet" href="{{ asset('css/checkoutFinish.css') }}">
@endsection

@section('content')
	<section class="order_details p_50">
		<div class="container">
			<h3 class="title_confirmation">Terima kasih, pesanan anda telah kami terima.</h3>
			<h6 class="title_confirmation" style="color: grey;">Silahkan cek email anda dan lakukan konfirmasi bukti transfer di dashboard anda</h6>
			<br><br><br>
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
                  				<span>Tanggal</span> : {{ $order->created_at->format('d-m-Y') }}</a>
							</li>
							<li>
								<a href="#">
                  				<span>Total</span> : Rp {{ number_format($order->subtotal) }}</a>
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
                  				<span>Kota</span> : {{ $order->kecamatan->kota->nama }}</a>
							</li>
							<li>
								<a href="#">
								<span>Negara</span> : Indonesia</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="details_item">
						<h4>Informasi Pembayaran</h4>
						<ul class="list">
							<li>
								<a href="#">
                  				<span>Subotal</span> : Rp {{ number_format($order->subtotal) }}</a>
							</li>
							<li>
								<a href="#">
                  				<span>Biaya pengiriman</span> : Rp {{ number_format($order->cost) }}</a>
							</li>
							<li>
								<a href="#">
                  				<span>Total</span> : Rp {{ number_format($order->total) }}</a>
							</li>
							<li>
								<a href="#">
                  				<span>Nomer Rekening</span> : {{ $order->pembayaran }}</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection