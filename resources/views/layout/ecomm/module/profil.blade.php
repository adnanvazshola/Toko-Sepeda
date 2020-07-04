<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h2 class="text-center">Data Diri</h2><br><br>
            </div>
        </div>
        <div class="card-body">
            <div class="row pl-4 pr-4 pt-4">
                <div class="col-sm-4">
                    <img src="{{ asset('storage/member/' . $member->foto) }}" alt="{{ $member->nama }}" style="width:250px; height: 250px; background-color: black;">
                </div>
                <div class="col-sm-8">
                    <table class="table table-hover table-borderless">
                        <tr>
                            <td width="20%"><h5>Nama            </td>
                            <td> : </td>
                            <td>{{ $member->nama }}</h5></td>
                        </tr>
                        <tr>
                            <td><h5>Email           </td>
                            <td> : </td>
                            <td>{{ $member->email }}</h5></td>
                        </tr>
                        <tr>
                            <td><h5>Telephone       </td>
                            <td> : </td>
                            <td>{{ $member->telephone }}</h5></td>
                        </tr>
                        <tr>
                            <td><h5>Alamat          </td>
                            <td> : </td>
                            <td>{{ $member->alamat }}, {{ $member->kecamatan->nama }}, {{ $member->kecamatan->kota->nama }}<br>
                                    {{ $member->kecamatan->kota->provinsi->nama }}, Indonesia ( {{ $member->kecamatan->kota->kodePos }} )</h5></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <br><br>
            <a href="{{ route('pelanggan.updateData', $member->id) }}" class="btn btn-danger align-content-center">Edit Profil</a>
        </div>
    </div>  
</div>