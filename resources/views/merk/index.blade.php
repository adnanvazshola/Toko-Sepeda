@extends('layout.admin')

@section('title')
    <title>Daftar Merk</title>
@endsection

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">merk</li>
    </ol>
    <div class="container-fluid container">
        <div class="animated fadeIn">
            <a class="btn btn-success mb-3" href="javascript:void(0)" id="createNewMerk">Tambah Merk</a>
            <table class="table table-hover data-table" id="merkTable">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Merk</th>
                        <th width="20%">Penanggung Jawab</th>
                        <th width="15%">Telephone</th>
                        <th width="20%">E-mail</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <div class="alert-danger print-error-msg text-danger" style="display:none; background: transparent;">
                        <ul></ul>
                    </div>
                    <form id="merkForm" name="merkForm" class="form-horizontal">
                    {{ csrf_field() }}
                        <input type="hidden" name="merk_id" id="merk_id">
                        <div class="form-group">
                            <label for="name" class=" control-label">Nama Merk</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan nama merk" value="" maxlength="100" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class=" control-label">Nama Sales</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="sales" name="sales" placeholder="Masukan nama sales" value="" maxlength="100" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class=" control-label">Telephone</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Masukan nomor telephone" value="" maxlength="13" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class=" control-label">E-mail</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukan email" value="" maxlength="100" required>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">
                                Simpan
                            </button>
                        </div>
                    </form>
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

            var table = $('#merkTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('merk.index') }}",            
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'nama', name: 'nama'},
                    {data: 'sales', name: 'sales'},
                    {data: 'telephone', name: 'telephone'},
                    {data: 'email', name: 'email'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
            });   


            $('#createNewMerk').click(function () {
                $('#saveBtn').val("create-merk");
                $('#merk_id').val('');
                $('#merkForm').trigger("reset");
                $('#modelHeading').html("Tambah Merk");
                $('#ajaxModel').modal('show');
            });

            $('body').on('click', '.editMerk', function () {
              var merk_id = $(this).data('id');
              $.get("{{ route('merk.index') }}" +'/' + merk_id +'/edit', function (data) {
                  $('#modelHeading').html("Edit Merk");
                  $('#saveBtn').val("edit-user");
                  $('#ajaxModel').modal('show');
                  $('#merk_id').val(data.id);
                  $('#nama').val(data.nama);
                  $('#sales').val(data.sales);
                  $('#telephone').val(data.telephone);
                  $('#email').val(data.email);
              })
            });
            
            $('#saveBtn').click(function (e) {
                e.preventDefault();

                var _token      = $("input[name='_token']").val();
                var nama        = $("input[name='nama']").val();
                var sales       = $("input[name='sales']").val();
                var telephone   = $("input[name='telephone']").val();
                var email       = $("input[name='email']").val();

                $(this).html('Sending..');
                $.ajax({
                    data: $('#merkForm').serialize(),
                    url: "{{ route('merk.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#productForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });

            $('body').on('click', '.deleteMerk', function () {
                var merk_id = $(this).data("id");
                confirm("Are You sure want to delete !");
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('merk.store') }}"+'/'+merk_id,
                    success: function (data) {
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });
        }); 
        
        function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
    </script>
@endsection