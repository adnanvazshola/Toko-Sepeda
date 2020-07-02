<style>
    text {
        color: auto;
        font-size: 17px;
        line-height: 1.8;
    }
</style>

<section class="login_box_area p_120">
    <div class="container">
        <div class="column">
                <div class="col-md-3">
                    @include('layout.ecomm.module.sidebar')
                </div>
                <h1><b>Profil</h1><br><br>
                    <div class="col-md-9">
                        <form action="{{ route('pelanggan.simpan', auth->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="content">
                                <table class="table-form" border="0" width="100%" cellpadding="0" cellspacing="0">
                                    <div class="form-group form-group--inline">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" id="first" name="pelanggan_nama" value="{{ auth()->guard('pelanggan')->user()->nama }}" required>
                                        <p class="text-danger">{{ $errors->first('pelanggan_nama') }}</p>
                                      </div>
                                      <div class="form-group form-group--inline">
                                        <label>Telephone</label>
                                        <input type="text" class="form-control" id="number" name="pelanggan_telephone" value="{{ auth()->guard('pelanggan')->user()->telephone }}" required>
                                        <p class="text-danger">{{ $errors->first('pelanggan_telephone') }}</p>
                                      </div>
                                      <div class="form-group form-group--inline">
                                        <label>Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ auth()->guard('pelanggan')->user()->email }}" required {{ auth()->guard('pelanggan')->check() ? 'readonly':'' }}>
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                      </div>
                                      <div class="form-group form-group--inline">
                                        <label>Alamat</label>
                                        <input type="text" class="form-control" id="add1" name="pelanggan_alamat" value="{{ auth()->guard('pelanggan')->user()->alamat }}" required>
                                        <p class="text-danger">{{ $errors->first('pelanggan_alamat') }}</p>
                                      </div>
                                        <td><label for="tempat_lahir">Tempat Lahir</label></td>
                                        <td><input name="tempat_lahir" id="tempat_lahir" type="text" class="form"></td>
                                        <div class="form-group form-group--inline">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tanggalLahir" name="tgl_lahir" value="{{ auth()->guard('pelanggan')->user()->tanggalLahir }}" required {{ auth()->guard('pelanggan')->check() ? 'readonly':'' }}>
                                            <p class="text-danger">{{ $errors->first('tanggalLahir') }}</p>
                                          </div>
                                    <tr>
                                        <td valign="top"><label for="alamat">Alamat</label></td>
                                        <td valign="top" colspan="2">
                                            <textarea name="alamat" id="alamat" class="form" cols="50" rows="8"></textarea>
                                        </td>
                                        <td valign="top">
                                            <div>
                                                <label for="kota">Kota</label>
                                                <input type="text" name="kota" id="kota" class="form">
                                            </div>
                                            <div>
                                                <label for="negara">Negara</label>
                                                <input type="text" name="negara" id="negara" class="form">
                                            </div>
                                            <div>
                                                <label for="kode_pos">Kode Pos</label>
                                                <input type="number" name="kode_pos" id="kode_pos" class="form">
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <input type="submit" class="btn" value="Simpan">
                            </form>
                    </div>
            </div>
        </div>

    </div>




</section>





