@extends('layout.ecomm')

@section('title')
    <title>Konfirmasi Pembayaran</title>
@endsection

@section('content')

    <main class="ps-main">
        <div class="container">
            <div class="card mt-5 mb-5">
                <div class="card-header">
                    <div class="card-title">
                        <h4>FORM KONFIRMASI PEMBAYARAN {{ request()->invoice }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('pelanggan.simpanPembayaran') }}" enctype="multipart/form-data" method="post">
                    @csrf
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <input type="hidden" name="invoice" value="{{ request()->invoice }}">
                        <div class="form-group">
                            <label for="">Nama Pengirim</label>
                            <input type="text" name="name" class="form-control" required>
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Transfer Ke</label>
                            <select name="transfer_to" class="form-control" required>
                                <option value="">Pilih</option>
                                <option value="BRI | 6919-01-01234-56-0">BRI | 6919-01-01234-56-0</option>
                                <option value="Paypal">Paypal</option>
                            </select>
                            <p class="text-danger">{{ $errors->first('transfer_to') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah Transfer</label>
                            <input type="number" name="amount" class="form-control" required>
                            <p class="text-danger">{{ $errors->first('amount') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Transfer</label>
                            <input type="date" name="transfer_date" class="form-control" required>
                            <p class="text-danger">{{ $errors->first('transfer_date') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Bukti Transfer</label>
                            <input type="file" name="proof" required>
                            <p class="text-danger">{{ $errors->first('proof') }}</p>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-lg">Konfirmasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>    

@endsection