@extends('layout.ecomm')
@section('title')
    <title>Cart</title>
@endsection

@section('content')
  <div class="ps-checkout pt-80 pb-80">
    <div class="ps-container">
          <form class="ps-checkout__form" action="#" method="post" novalidate="novalidate">
          @csrf
            <div class="row">
              <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                <div class="ps-checkout__billing">
                  <h3>Billing Detail</h3>
                  @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  @if (auth()->guard('pelanggan')->check())
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
                  @else
                    <div class="form-group form-group--inline">
                      <label>Nama</label>
                      <input type="text" class="form-control" id="first" name="pelanggan_nama" required>
                      <p class="text-danger">{{ $errors->first('pelanggan_nama') }}</p>
                    </div>
                    <div class="form-group form-group--inline">
                      <label>Telephone</label>
                      <input type="text" class="form-control" id="number" name="pelanggan_telephone" required>
                      <p class="text-danger">{{ $errors->first('pelanggan_telephone') }}</p>
                    </div>
                    <div class="form-group form-group--inline">
                      <label>Email</label>
                      <input type="email" class="form-control" id="email" name="email" required>
                      <p class="text-danger">{{ $errors->first('email') }}</p>
                    </div>
                    <div class="form-group form-group--inline">
                      <label>Alamat</label>
                      <input type="text" class="form-control" id="add1" name="pelanggan_alamat" required>
                      <p class="text-danger">{{ $errors->first('pelanggan_alamat') }}</p>
                    </div>
                  @endif
                  <div class="form-group form-group--inline">
                    <label for="">Propinsi</label>
                    <select class="form-control" name="provinsi_id" id="provinsi_id" required>
                      <option value="">Pilih Propinsi</option>
                      @foreach ($provinsi as $row)
                        <option value="{{ $row->id }}">{{ $row->nama }}</option>
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
                      <label for="">Kurir</label>
                      <input type="text" name="berat" id="berat" value="{{ $berat }}">
                      <select class="form-control" name="courier" id="courier" required>
                          <option value="">Pilih Kurir</option>
                      </select>
                      <p class="text-danger">{{ $errors->first('courier') }}</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                <div class="ps-checkout__order">
                  <header>
                    <h3>Your Order</h3>
                  </header>
                  <div class="content">
                    <table class="table ps-checkout__products">
                      <thead>
                        <tr>
                          <th class="text-uppercase" colspan="2">Product</th>
                          <th class="text-uppercase">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($carts as $cart)
                        <tr>
                          <td><a href="#">{{ \Str::limit($cart['produk_nama'], 10) }}</td>
                          <td>x {{ $cart['qty'] }}</td>
                          <td>Rp {{ number_format($cart['produk_harga']) }}</td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                  <footer>
                    <h3>Payment Method</h3>
                    <div class="form-group cheque">
                      <div class="ps-radio ps-radio--inline">
                        <input class="form-control" type="radio" id="rdo01" name="pembayaran" value="BRI | 6919-01-01234-56-0" checked>
                        <label for="rdo01">Bank Transfer</label>
                      </div>
                      <ul class="ps-payment-method">
                        <li><a href="#"><img src="{{ asset('img/payment/atmBersama.jpg') }}" alt=""></a></li>
                        <li><a href="#"><img src="{{ asset('img/payment/prima.png') }}" alt=""></a></li>
                      </ul>
                    </div>
                    <div class="form-group paypal">
                      <div class="ps-radio ps-radio--inline">
                        <input class="form-control" type="radio" id="rdo02" name="pembayaran" value="Paypal">
                        <label for="rdo02">Paypal</label>
                      </div>
                      <ul class="ps-payment-method">
                        <li><a href="#"><img src="{{ asset('img/payment/1.png') }}" alt=""></a></li>
                        <li><a href="#"><img src="{{ asset('img/payment/2.png') }}" alt=""></a></li>
                        <li><a href="#"><img src="{{ asset('img/payment/3.png') }}" alt=""></a></li>
                      </ul>
                    </div>
                    <div class="form-group cheque">
                      <div class="ps-radio">
                        <p>
                          <h5 style="color: white;">
                            subtotal    <span>: Rp. {{ number_format($subtotal) }}</span><br>
                            Pengiriman  <span id="ongkir">: Rp. 0</span><br>
                            Total       <span id="total">Rp. {{ number_format($subtotal) }}</span>
                          </h5>
                        </p>
                      </div>
                    </div>
                    <div class="form-group paypal">
                      <button class="ps-btn ps-btn--fullwidth">Place Order<i class="ps-icon-next"></i></button>
                    </div>
                  </footer>
                </div>
              </div>
        </div>
      </form>
        </div>
      </div>
@endsection

@section('js')
    <script>
        $('#provinsi_id').on('change', function() {
            $.ajax({
                url: "{{ url('/api/kota') }}",
                type: "GET",
                data: { provinsi_id: $(this).val() },
                success: function(html){
                    $('#kota_id').empty()
                    $('#kota_id').append('<option value="">Pilih Kabupaten/Kota</option>')
                    $.each(html.data, function(key, item) {
                        $('#kota_id').append('<option value="'+item.id+'">'+item.nama+'</option>')
                    })
                }
            });
        })

        $('#kota_id').on('change', function() {
            $.ajax({
                url: "{{ url('/api/kecamatan') }}",
                type: "GET",
                data: { kota_id: $(this).val() },
                success: function(html){
                    $('#kecamatan_id').empty()
                    $('#kecamatan_id').append('<option value="">Pilih Kecamatan</option>')
                    $.each(html.data, function(key, item) {
                        $('#kecamatan_id').append('<option value="'+item.id+'">'+item.nama+'</option>')
                    })
                }
            });
        })


        //JIKA KECAMATAN DIPILIH
        $('#kecamatan_id').on('change', function() {
            //MEMBUAT EFEK LOADING SELAMA PROSES REQUEST BERLANGSUNG
            $('#courier').empty()
            $('#courier').append('<option value="">Loading...</option>')
          
            //MENGIRIM PERMINTAAN KE SERVER UNTUK MENGAMBIL DATA API
            $.ajax({
                url: "{{ url('/api/cost') }}",
                type: "POST",
                data: { destination: $(this).val(), weight: $('#berat').val() },
                success: function(html){
                    //BERSIHKAN AREA SELECT BOX
                    $('#courier').empty()
                    $('#courier').append('<option value="">Pilih Kurir</option>')
                  
                    //LOOPING DATA ONGKOS KIRIM
                    $.each(html.data.results, function(key, item) {
                        let courier = item.courier + ' - ' + item.service + ' (Rp '+ item.cost +')'
                        let value = item.courier + '-' + item.service + '-'+ item.cost
                        //DAN MASUKKAN KE DALAM OPTION SELECT BOX
                        $('#courier').append('<option value="'+value+'">' + courier + '</option>')
                    })
                }
            });
        })

        //JIKA KURIR DIPILIH
        $('#courier').on('change', function() {
            //UPDATE INFORMASI BIAYA PENGIRIMAN
            let split = $(this).val().split('-')
            $('#ongkir').text('Rp ' + split[2])

            //UPDATE INFORMASI TOTAL (SUBTOTAL + ONGKIR)
            let subtotal = "{{ $subtotal }}"
            let total = parseInt(subtotal) + parseInt(split['2'])
            $('#total').text('Rp' + total)
        })
    </script>
@endsection