@extends('layout.admin')

@section('title')
    <title>Kategori</title>
@endsection

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <h4 class="card-title" id="cardHeading">Kategori Baru</h4>
                </div>
                <div class="card-body">
                    <form id="kategoriForm" name="kategoriForm">
                    {{ csrf_field() }}
                        <div class="row">
                            <input type="hidden" name="id" id="kategori_id">
                            <div class="form-group col-md-4">
                                <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukan nama kategori" required>
                                <p class="text-danger">{{ $errors->first('nama') }}</p>
                            </div>
                            <div class="form-group col-md-4">
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="">Pilih kategori turunan</option>
                                    @foreach ($parent as $row)
                                        <option value="{{ $row->nama }}">{{ $row->nama }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('nama') }}</p>
                            </div>
                            <div class="form-group col-md-auto">
                                <button class="btn btn-primary" id="saveBtn" value="create">Tambah</button>
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
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered data-table" id="kategoriTable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kategori</th>
                                    <th>Parent</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')

    <script type="text/javascript">
        
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#kategoriTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('kategori.index') }}",            
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'nama', name: 'nama'},
                    {data: 'parent_id', name: 'parent_id'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    //{data: '$data->parent->nama', name: '$data->parent ? $data->parent->nama:'-''},
              ]
            });   

            $('#saveBtn').click(function (e) {
                e.preventDefault();

                $.ajax({
                    data: $('#kategoriForm').serialize(),
                    url: "{{ route('kategori.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#kategoriForm').trigger("reset");
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });

            $('body').on('click', '.deleteKategori', function () {
                var kategori_id = $(this).data("id");
                confirm("Are You sure want to delete !");
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('kategori.store') }}"+'/'+kategori_id,
                    success: function (data) {
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });
        });

    </script>
@endsection