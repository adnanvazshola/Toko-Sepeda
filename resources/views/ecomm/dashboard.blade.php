@extends('layout.ecomm')
@section('title')
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/menudashboard.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('/css/kupon.css') }}"> --}}
@endsection

@section('content')

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<button class="tablink" onclick="openPage('Home', this, 'red')" id="defaultOpen">Akun Saya</button>
<button class="tablink" onclick="openPage('News', this, 'green')">Pesanan Saya</button>
<button class="tablink" onclick="openPage('Contact', this, 'blue')">Favorites</button>
<button class="tablink" onclick="openPage('About', this, 'orange')">Voucher Saya</button>

<div id="Home" class="tabcontent">
    <h1><b>Akun Saya</h1><br/>
        <div class="kotak">
            <section class="login_box_area p_120">
                <div class="container">
                    <div class="column">
                        <div class="col-md-3">
                            @include('layout.ecomm.module.sidebar')
                        </div>
                        <h1><b>Profil</h1><br/>
                        <div class="col-md-9">
                            <div class="column">
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <form>
                                                <label for="nama">Nama Lengkap:</label><br>
                                                <input type="text" id="nama" name="nama"><br>
                                                <label for="email">Email:</label><br>
                                                <input type="text" id="email" name="email">
                                                <label for="jenkel">Jenis Kelamin:</label><br>
                                                <input type="text" id="jenkel" name="jenkel"><br>
                                                <label for="tgl">Tanggal Lahir:</label><br>
                                                <input type="text" id="tgl" name="tgl">
                                                <label for="alamat">Alamat:</label><br>
                                                <input type="text" id="alamat" name="alamat"><br>
                                                <label for="notelp">Nomer Telephone:</label><br>
                                                <input type="text" id="notelp" name="notelp">
                                              </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
</div>

<div id="News" class="tabcontent">
  <h1><b>Pesanan Saya</h1><br/>
  <div class="kotak">
    <section class="login_box_area p_120">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					@include('layout.ecomm.module.sidebar')
                </div>
                    <div class="col-md-9">
                        <div class="column">
                            <div class="col-md-4">
                                <div class="card text-center">
                                    <div class="card-body">
									<h3>Telah di Dibayar</h3>
									<hr>
									<p>Rp {{ number_format($orders[0]->ditunda) }}</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card text-center">
								<div class="card-body">
									<h3>Dikirim</h3>
									<hr>
									<p>{{ number_format($orders[0]->dikirim) }} Pesanan</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card text-center">
								<div class="card-body">
									<h3>Selesai</h3>
									<hr>
									<p>{{ $orders[0]->selesaiOrder }} Pesanan</p>
								</div>
							</div>
                        </div>
                        <div class="col-md-4">
							<div class="card text-center">
								<div class="card-body">
									<h3>Menunggu Komentar</h3>
									<hr>
									<p>{{ $orders[0]->selesaiOrder }} Pesanan</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
  </div>
</div>

<div id="Contact" class="tabcontent">
  <h1><b>Favorites</h1><br/>
  <div class="kotak">
    <section class="login_box_area p_120">
        <div class="container">
            <div class="column">
                <div class="col-md-3">
                    @include('layout.ecomm.module.sidebar')
                </div>
                <h1><b>Daftar Favorites</h1><br/>
                <div class="col-md-9">
                    <div class="column">
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h3>Anda belum menambahkan Favorites</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </div>
</div>

<div id="About" class="tabcontent">
  <h1><b>Voucher Saya</h1><br/>
    <div class="kotak">
      <section class="login_box_area p_120">
          <div class="container">
              <div class="column">
                <div class="col-md-3">
                    @include('layout.ecomm.module.sidebarvoc')
                </div>
                <h1><b>Voucher</h1><br/>
                  <div class="col-md-9">
                      <div class="column">
                          <div class="col-md-4">
                              <div class="card text-center">
                                  <div class="card-body">
                                        <div class="coupon">
                                            <div class="containerrr">
                                            <h3>POLYGON</h3>
                                            </div>
                                            <img src="{{ asset('img/pgonp4.png') }}" alt="Avatar" style="width:100%;">
                                            <div class="containerrr" style="background-color:white">
                                            <h2><b>15% OFF YOUR PURCHASE</b></h2>
                                            <p>Untuk pembelian sepeda POLYGON di atas Rp.10.000.000</p>
                                            </div>
                                            <div class="containerrr">
                                            <p>Use Promo Code: <span class="promo">BIKE9237</span></p>
                                            <p class="expire">Expires: Jan 23, 2021</p>
                                            </div>
                                        </div>
                                    </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
    </div>
</div>

<script>
function openPage(pageName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

</body>
</html>

@endsection
