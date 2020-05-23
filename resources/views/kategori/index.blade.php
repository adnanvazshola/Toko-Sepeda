@extends('layout.admin')

@section('title')
    <title>Kategori</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Kategori</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Kategori Baru</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('kategori.store') }}" method="post">
                    @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <input type="text" name="nama" class="form-control" placeholder="Masukan nama kategori" required>
                                <p class="text-danger">{{ $errors->first('nama') }}</p>
                            </div>
                            <div class="form-group col-md-4">
                                <select name="parent_id" class="form-control">
                                    <option value="">Pilih kategori turunan</option>
                                    @foreach ($parent as $row)
                                        <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('nama') }}</p>
                            </div>
                            <div class="form-group col-md-auto">
                                <button class="btn btn-primary">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List Kategori</h4>
                </div>
                <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kategori</th>
                                    <th>Parent</th>
                                    <th>Created At</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kategori as $c)
                                    <tr>
                                        <td></td>
                                        <td><strong>{{ $c->nama }}</strong></td>
                                        <td>{{ $c->parent ? $c->parent->nama:'-' }}</td>
                                        <td>{{ $c->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <form action="{{ route('kategori.destroy', $c->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                                <a href="{{ route('kategori.edit', $c->id) }}" class="btn btn-warning btn-sm">Edit</a>
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
                    {!! $kategori->links() !!}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection