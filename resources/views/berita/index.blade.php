@extends('layout.admin')

@section('title')
    <title>Berita</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Berita</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                Daftar Berita
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
                                    <a href="{{ route('berita.create') }}" class="btn btn-warning">Tambah</a>
                                </div>
                                <form action="{{ route('berita.index') }}" method="get" class="col-md-auto">
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
                                            <th>Judul</th>
                                            <th>Penulis</th>
                                            <th>Tanggal</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($berita as $b)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/berita/' . $b->foto) }}" width="100px" height="100px" alt="{{ $b->judul }}">
                                            </td>
                                            <td>
                                                <strong>{{ $b->judul }}</strong>
                                            </td>
                                            <td>{{ $b->user->name }}</td>
                                            <td>{{ $b->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <form action="{{ route('berita.destroy', $b->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('berita.edit', $b->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- MEMBUAT LINK PAGINASI JIKA ADA -->
                            {!! $berita->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection