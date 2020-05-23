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
                    <input type="text" class="form-control" id="email" name="email" required>
                    <p class="text-danger">{{ $errors->first('email') }}</p>
                  </div>
                  <div class="form-group form-group--inline">
                    <label>Alamat<span>*</span></label>
                    <input type="text" class="form-control" id="add1" name="pelanggan_alamat" required>
                    <p class="text-danger">{{ $errors->first('pelanggan_alamat') }}</p>
                  </div>
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

                  <h3 class="mt-40"> Addition information</h3>
                  <div class="form-group form-group--inline textarea">
                    <label>Order Notes</label>
                    <textarea class="form-control" rows="5" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
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
                    <div class="form-group cheque">
                      <div class="ps-radio">
                        <h5 style="color: white;">
                          <div class="row">
                          Total :
                          Rp {{ number_format($subtotal) }}
                          </div>
                        </h5>
                      </div>
                    </div>
                    <div class="form-group paypal">
                      <button class="ps-btn ps-btn--fullwidth">Place Order<i class="ps-icon-next"></i></button>
                    </div>
                  </footer>
                </div>
                <div class="ps-shipping">
                  <h3>FREE SHIPPING</h3>
                  <p>YOUR ORDER QUALIFIES FOR FREE SHIPPING.<br> <a href="#"> Singup </a> for free shipping on every order, every time.</p>
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
    </script>
@endsection