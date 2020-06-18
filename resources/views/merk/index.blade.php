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
            <a class="btn btn-success" href="javascript:void(0)" id="createNewMerk"> Create New Merk</a>
            <table class="table table-bordered data-table" id="merkTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Merk</th>
                        <th>Sales</th>
                        <th>Telephone</th>
                        <th>email</th>
                        <th width="280px">Action</th>
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
                    <form id="merkForm" name="merkForm" class="form-horizontal">
                        <input type="hidden" name="merk_id" id="merk_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nama Merk</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan nama merk" value="" maxlength="100" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nama Sales</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="sales" name="sales" placeholder="Masukan nama sales" value="" maxlength="100" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Telephone</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Masukan nomor telephone" value="" maxlength="13" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">E-mail</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Masukan email" value="" maxlength="100" required>
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
              data : { 
                "id"            : $("#id").val(), 
                "nama"          : $("#nama").val(), 
                "sales"         : $("#sales").val(), 
                "telephone"     : $("#telephone").val(),
                "email"         : $("#email").val()} ,                
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
                $(this).html('Sending..');
                $.ajax({
                  data: $('#merkForm').serialize(),
                  url: "{{ route('merk.store') }}",
                  type: "POST",
                  dataType: 'json',
                  success: function (data) {
                      $('#merkForm').trigger("reset");
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
        
    </script>
@endsection