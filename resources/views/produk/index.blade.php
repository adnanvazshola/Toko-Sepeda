@extends('layout.admin')

@section('title')
    <title>Daftar Produk</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Produk</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                List Product
                            </h4>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <div class="row">
                                <div class="col-md-9">
                                    <a href="{{ route('produk.massal') }}" class="btn btn-danger">Upload Massal</a>
                                    <a href="{{ route('produk.create') }}" class="btn btn-warning">Tambah</a>
                                </div>
                                <form action="{{ route('produk.index') }}" method="get" class="col-md-auto">
                                    <div class="input-group float-right mb-2">
                                        <input type="text" name="s" class="form-control" placeholder="Cari..." value="{{ request()->s }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button">Cari</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="110px">#</th>
                                            <th>Produk</th>
                                            <th>Stok</th>
                                            <th>Harga</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($produk as $p)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/produk/' . $p->foto) }}" width="100px" height="100px" alt="{{ $p->nama }}">
                                            </td>
                                            <td>
                                                <strong>{{ $p->merk->nama }} - {{ $p->nama }}</strong><br>
                                                <table class="table-borderless">
                                                    <tr>
                                                        <label>Kategori :    <span class="badge badge-info"> {{ $p->kategori->nama }}</span></label><br>
                                                        <label>Warna    :    <span class="badge badge-info"> {{ $p->warna['nama'] }}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td><strong>{{ $p->stok }}</strong> buah</td>
                                            <td>Rp. {{ number_format($p->harga) }}</td>
                                            <td>{{ $p->created_at->format('d-m-Y') }}</td>
                                            <td>{!! $p->status_label !!}</td>
                                            <td>
                                                <form action="{{ route('produk.destroy', $p->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('produk.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- MEMBUAT LINK PAGINASI JIKA ADA -->
                            {!! $produk->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection