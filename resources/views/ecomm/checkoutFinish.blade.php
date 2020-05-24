@extends('layout.ecomm')
@section('title')
    <title>Berhasil Pesan</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/checkoutFinish.css') }}">
@endsection

@section('content')
	<section class="order_details p_120">
		<div class="container">
			<h2 class="title_confirmation">Terima kasih, pesanan anda telah kami terima.</h2>
			<h5 class="title_confirmation mb-80">Jangan lupa konfirmasi pembayaran pada dashboard anda</h5>
			<div class="row order_d_inner">
				<div class="col-lg-6">
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
                  				<span>Total</span> : Rp. {{ number_format($order->subtotal) }}</a>
							</li>
							<li>
								<a href="#">
                  				<span>Pembayaran</span> : {{ $order->pembayaran }}</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6">
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
			</div>
		</div>
	</section>
@endsection