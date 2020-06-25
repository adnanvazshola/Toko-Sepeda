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
                <h1><b>Daftar Favorites</h1><br><br>
                    <div class="col-md-9">
                        <form>
                            <label for="nama">Nama Lengkap:</label>
                            {{-- <p>{{ $pelanggans }}</p> --}}
                            <input type="text" id="nama" name="nama"><br><br>
                            <label for="email">Email:</label>
                            <input type="text" id="email" name="email"><br><br>
                            <label for="jenkel">Jenis Kelamin:</label>
                            <input type="text" id="jenkel" name="jenkel"><br><br>
                            <label for="tgl">Tanggal Lahir:</label>
                            <input type="text" id="tgl" name="tgl"><br><br>
                            <label for="alamat">Alamat:</label>
                            <input type="text" id="alamat" name="alamat"><br><br>
                            <label for="notelp">Nomer Telephone:</label>
                            <input type="text" id="notelp" name="notelp"><br><br>
                        </form>
                    </div>
            </div>
        </div>

    </div>




</section>





