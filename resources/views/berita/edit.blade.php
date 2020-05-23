@extends('layout.admin')

@section('title')
    <title>Edit Berita</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Berita</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <form action="{{ route('berita.update', $berita->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Update Berita</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Judul :</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="judul" value="{{ $berita->judul }}" required>
                            </div>
                            <p class="text-danger">{{ $errors->first('judul') }}</p>
                        </div>
                        <div class="form-group" hidden>
                            <label>Penulis :</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="user_id" value="{{ $berita->user_id }}" required>
                            </div>
                            <p class="text-danger">{{ $errors->first('user_id') }}</p>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="isi">Isi Berita :</label>
                                    <textarea name="isi" id="isi" class="form-control">{{ $berita->isi }}</textarea>
                                    <p class="text-danger">{{ $errors->first('isi') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                                    <label for="image">Foto Produk</label>
                                    <br>
                                    <img src="{{ asset('storage/berita/' . $berita->foto) }}" width="100px" height="100px" alt="{{ $berita->judul }}">
                                    <hr>
                                    <input type="file" name="foto" class="form-control">
                                    <p><strong>Biarkan kosong jika tidak ingin mengganti gambar</strong></p>
                                    <p class="text-danger">{{ $errors->first('foto') }}</p>
                                </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@section('js')
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('isi');
    </script>
@endsection