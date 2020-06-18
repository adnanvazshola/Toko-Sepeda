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
                    <h4 class="card-title">List Kategori</h4>
                </div>
                <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                    <a class="btn btn-success my-4" href="javascript:void(0)" id="createNewProduct"> Tambah Kategori</a>
                    <div class="table-responsive">
                        <table id="anjing" class="table table-hover table-bordered data-table">
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


