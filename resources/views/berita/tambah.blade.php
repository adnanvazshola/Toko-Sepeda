@extends('layout.admin')

@section('title')
    <title>Tulis Berita</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Berita</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <form action="{{ route('berita.store') }}" method="post" enctype="multipart/form-data" >
            @csrf
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Berita</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Judul :</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="judul" value="{{ old('judul') }}" required>
                            </div>
                            <p class="text-danger">{{ $errors->first('judul') }}</p>
                        </div>
                        <div class="form-group" hidden>
                            <label>Penulis :</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="user_id" value="{{ Auth::user()->id }}" required>
                            </div>
                            <p class="text-danger">{{ $errors->first('user_id') }}</p>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="desc">Isi Berita :</label>
                                    <textarea name="isi" id="isi" class="form-control">{{ old('isi') }}</textarea>
                                    <p class="text-danger">{{ $errors->first('isi') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" class="form-control" value="{{ old('foto') }}" required>
                            <p class="text-danger">{{ $errors->first('foto') }}</p>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Tambah</button>
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
<script type="text/javascript">
    $(function () {
        CKEDITOR.replace('isi');
    });
</script>
@endsection