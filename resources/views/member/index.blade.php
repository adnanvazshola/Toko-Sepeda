@extends('layout.admin')

@section('title')
    <title>Member</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Member</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <h4 class="col-md-9">
                                    Daftar Member
                                </h4>
                                <form action="{{ route('member') }}" method="get" class="col-md-auto">
                                    <div class="input-group float-right mb-2">
                                        <input type="text" name="s" class="form-control" placeholder="Cari..." value="{{ request()->s }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button">Cari</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
                                            <th width="5%">ID</th>
                                            <th width="25%">Nama</th>
                                            <th width="15%">Email</th>
                                            <th width="15%">Telephone</th>
                                            <th width="20%">Alamat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($member as $m)
                                        <tr>
                                            <td>{{ $m->id }}</td>
                                            <td>{{ $m->nama }}</td>
                                            <td>{{ $m->email }}</td>
                                            <td>{{ $m->telephone }}</td>
                                            <td>{{ $m->alamat }}</td>
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
                            {!! $member->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection