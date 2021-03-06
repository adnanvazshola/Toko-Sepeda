@extends('layout.ecomm')
@section('title')
    <title>Edit Profile - {{ $member->nama }}</title>
@endsection

@section('content')
    <main class="ps-main pt-3">
      <div class="container">
        <form action="{{ route('pelanggan.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="form-group">
              <center>
                <img src="{{ asset('storage/member/' . $member->foto) }}" alt="{{ $member->nama }}" class="rounded-circle" style="width:250px; height: 250px; border-radius: 50%; background-color: black;" >
                <input type="file" name="foto">
                <p class="text-danger">{{ $errors->first('foto') }}</p>
              </center>
            </div>
            <input type="hidden" name="id" value="{{ $member->id }}">
            <div class="form-group form-group--inline">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" value="{{ $member->nama }}" required>
                <p class="text-danger">{{ $errors->first('nama') }}</p>
            </div>
            <div class="form-group form-group--inline">
                <label>E-mail</label>
                <input type="text" class="form-control" name="email" value="{{ $member->email }}" readonly>
                <p class="text-danger">{{ $errors->first('email') }}</p>
            </div>
            <div class="form-group form-group--inline">
                <label>Telephone</label>
                <input type="text" class="form-control" name="telephone" value="{{ $member->telephone }}" required>
                <p class="text-danger">{{ $errors->first('telephone') }}</p>
            </div>
            <div class="form-group form-group--inline">
                <label>Alamat</label>
                <input type="text" class="form-control" name="alamat" value="{{ $member->alamat }}" required>
                <p class="text-danger">{{ $errors->first('alamat') }}</p>
            </div>
            <div class="form-group form-group--inline">
                <label>Provinsi</label>
                <select class="form-control" name="provinsi_id" id="provinsi_id" required>
                    <option value="">Pilih Propinsi</option>
                    @foreach ($provinsi as $row)
                      <option value="{{ $row->id }}" {{ $member->kecamatan->provinsi_id == $row->id ? 'selected':'' }}>{{ $row->nama }}</option>
                    @endforeach
                </select>
                <p class="text-danger">{{ $errors->first('provinsi_id') }}</p>
            </div>
            <div class="form-group form-group--inline">
                <label for="">Kabupaten / Kota</label>
                <select class="form-control" name="kota_id" id="kota_id" required>
                    <option value="">Pilih Kabupaten/Kota</option>
                </select>
                <p class="text-danger">{{ $errors->first('kota_id') }}</p>
            </div>
            <div class="form-group form-group--inline">
                <label for="">Kecamatan</label>
                <select class="form-control" name="kecamatan_id" id="kecamatan_id" required>
                    <option value="">Pilih Kecamatan</option>
                </select>
                <p class="text-danger">{{ $errors->first('kecamatan_id') }}</p>
            </div>
            <div class="form-group form-group--inline">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Biarkan kosong jika tidak ingin mengganti password" value="">
                <p class="text-danger">{{ $errors->first('password') }}</p>
                <small><b>biarkan password kosong jika tidak ingin mengganti</b></small>
            </div>
            <button class="btn btn-primary btn-lg mb-4">Simpan</button>
        </form><br><br>
      </div>
    </main>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            loadKota($('#provinsi_id').val(), 'bySelect').then(() => {
                loadKecamatan($('#kota_id').val(), 'bySelect');
            })
        })
        $('#provinsi_id').on('change', function() {
            loadKota($(this).val(), '');
        })
        $('#kota_id').on('change', function() {
            loadKecamatan($(this).val(), '')
        })
        function loadKota(provinsi_id, type) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: "{{ url('/api/kota') }}",
                    type: "GET",
                    data: { provinsi_id: provinsi_id },
                    success: function(html){
                        $('#kota_id').empty()
                        $('#kota_id').append('<option value="">Pilih Kabupaten/Kota</option>')
                        $.each(html.data, function(key, item) {
                            let kota_selected = {{ $member->kecamatan->kota_id }};
                            let selected = type == 'bySelect' && kota_selected == item.id ? 'selected':'';
                            $('#kota_id').append('<option value="'+item.id+'" '+ selected +'>'+item.nama+'</option>')
                            resolve()
                        })
                    }
                });
            });
        }
        function loadKecamatan(kota_id, type) {
            $.ajax({
                url: "{{ url('/api/kecamatan') }}",
                type: "GET",
                data: { kota_id: kota_id },
                success: function(html){
                    $('#kecamatan_id').empty()
                    $('#kecamatan_id').append('<option value="">Pilih Kecamatan</option>')
                    $.each(html.data, function(key, item) {
                        let kecamatan_selected = {{ $member->kecamatan->id }};
                        let selected = type == 'bySelect' && kecamatan_selected == item.id ? 'selected':'';
                        $('#kecamatan_id').append('<option value="'+item.id+'" '+ selected +'>'+item.nama+'</option>')
                    })
                }
            });
        }
    </script>
@endsection