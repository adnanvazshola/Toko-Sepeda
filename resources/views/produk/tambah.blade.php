@extends('layout.admin')

@section('title')
    <title>Tambah Produk</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Produk</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <form action="{{ route('produk.store') }}" method="post" enctype="multipart/form-data" >
            @csrf
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Produk</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Produk :</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" required>
                            </div>
                            <p class="text-danger">{{ $errors->first('nama') }}</p>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Merk :</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <select name="merk_id" class="form-control custom-select">
                                            <option value="">Pilih</option>
                                            @foreach ($merk as $m)
                                                <option value="{{ $m->id }}" {{ old('merk_id') == $m->id ? 'selected':'' }}>{{ $m->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <p class="text-danger">{{ $errors->first('merk_id') }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kategori :</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <select name="kategori_id" class="form-control custom-select">
                                            <option value="">Pilih</option>
                                            @foreach ($kategoris as $k)
                                                <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected':'' }}>{{ $k->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <p class="text-danger">{{ $errors->first('kategori_id') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Warna :</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <select name="warna_id[]" class="form-control custom-select select2" multiple data-placeholder="Pilih Warna">
                                            @foreach ($warna as $w)
                                                <option value="{{ $w->id }}" {{ old('warna_id') == $w->id ? 'selected':'' }}>{{ $w->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Ukuran :</label>
                                        <div class="input-group">
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="ukuran[]" class="ml-2" value="All Size">All Size
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="ukuran[]" class="ml-2" value="XS"> XS
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="ukuran[]" class="ml-2" value="S"> S
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="ukuran[]" class="ml-2" value="M"> M
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="ukuran[]" class="ml-2" value="L"> L
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="ukuran[]" class="ml-2" value="XL"> XL
                                            </label>
                                        </div>
                                        <p class="text-danger">{{ $errors->first('ukuran') }}</p>
                                    </div>
                                    <p class="text-danger">{{ $errors->first('ukuran') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stok Produk :</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="number" class="form-control" name="stok" value="{{ old('stok') }}" required>
                                    </div>
                                    <p class="text-danger">{{ $errors->first('stok') }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Berat Produk :</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="number" class="form-control" name="weight" value="{{ old('weight') }}" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Gram</span>
                                        </div>
                                    </div>
                                    <p class="text-danger">{{ $errors->first('weight') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Harga Produk :</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="number" class="form-control" name="harga" value="{{ old('harga') }}" required>
                                    </div>
                                    <p class="text-danger">{{ $errors->first('harga') }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <select name="status" class="form-control" required>
                                            <option value="1" {{ old('status') == '1' ? 'selected':'' }}>Publish</option>
                                            <option value="0" {{ old('status') == '0' ? 'selected':'' }}>Draft</option>
                                        </select>
                                    </div>
                                    <p class="text-danger">{{ $errors->first('status') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="desc">Deskripsi Produk :</label>
                                    <textarea name="desc" id="desc" class="form-control">{{ old('desc') }}</textarea>
                                    <p class="text-danger">{{ $errors->first('desc') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto Produk</label>
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
        $('.select2').select2();
        CKEDITOR.replace('desc');
    });
</script>
@endsection
