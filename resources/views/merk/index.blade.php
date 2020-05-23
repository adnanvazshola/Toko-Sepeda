@extends('layout.admin')

@section('title')
    <title>Daftar Merk</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">merk</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Merk</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('merk.store') }}" method="post">
                            @csrf
                                <div class="form-group">
                                    <input type="text" name="nama" class="form-control" placeholder="Masukan nama merk" value="{{ old('nama') }}" required>
                                    <p class="text-danger">{{ $errors->first('nama') }}</p>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="sales" class="form-control" placeholder="Masukan nama lengkap sales" value="{{ old('sales') }}" required>
                                    <p class="text-danger">{{ $errors->first('sales') }}</p>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="telephone" class="form-control" placeholder="Masukan nomer HP" value="{{ old('telephone') }}" required>
                                    <p class="text-danger">{{ $errors->first('telephone') }}</p>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Masukan email sales" value="{{ old('email') }}" required>
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Merk</h3>
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
                                            <th>merk</th>
                                            <th>Sales</th>
                                            <th>Telephone</th>
                                            <th>email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($merks as $m)
                                            <tr>
                                                <td></td>
                                                <td><strong>{{ $m->nama }}</strong></td>
                                                <td>{{ $m->sales }}</td>
                                                <td>{{ $m->telephone }}</td>
                                                <td>{{ $m->email }}</td>
                                                <td>
                                                    <form action="{{ route('merk.destroy', $m->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                        <a href="{{ route('merk.edit', $m->id) }}" class="btn btn-warning btn-sm">Edit</a>
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
                            {!! $merks->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection