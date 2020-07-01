@extends('layout.ecomm')
@section('title')
    <title>Cart</title>
@endsection

@section('content')
      <div class="ps-content pt-80 pb-80">
        <div class="ps-container">
          <div class="ps-cart-listing">
            <form action="{{ route('front.update_cart') }}" method="post">
            @csrf
              <table class="table ps-cart__table">
                <thead>
                  <tr>
                    <th colspan="2">Produk</th>
                    <th>Harga</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($carts as $row)
                    <tr>
                        <td>
                            <a class="ps-product__preview" href="#">
                                <img class="mr-15" src="{{ asset('storage/produk/' . $row['produk_foto']) }} " alt="{{ $row['produk_nama'] }}" style="width: 100px; height: 100px;">
                            </a>
                        </td>
                        <td>
                            {{ $row['produk_nama'] }}<br>
                            <small>Ukuran   : {{ $row['ukuran'] }}</small><br>
                            <small>Berat   : {{ $row['weight'] }} gram</small><br>
                            <small>Catatan  : {{ $row['catatan'] }}</small>
                        </td>
                        <td>Rp. {{ number_format($row['produk_harga']) }}</td>
                        <td>
                            <div class="form-group--number">
                                <button onclick="var result = document.getElementById('sst{{ $row['produk_id'] }}'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;" class="minus" type="button">
                                    <span>-</span>
                                </button>
                                
                                <input type="text" name="qty[]" id="sst{{ $row['produk_id'] }}" maxlength="12" value="{{ $row['qty'] }}" title="Quantity:" class="form-control">
                                <input type="hidden" name="produk_id[]" value="{{ $row['produk_id'] }}" class="form-control">
                                
                                <button onclick="var result = document.getElementById('sst{{ $row['produk_id'] }}'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="plus" type="button">
                                    <span>+</span>
                                </button>
                            </div>
                        </td>
                        <td>Rp. {{ number_format($row['produk_harga'] * $row['qty']) }}</td>
                        <td>
                            <div class="ps-remove"></div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">Tidak ada belanjaan</td>
                    </tr>
                  @endforelse
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="2"><h4>Total Belanja: <span>Rp. {{ number_format($subtotal) }}</span></h4></td>
                    </tr>
                    <tr>
                        <td colspan="4"><button class="ps-btn ps-btn--gray">Update Cart</button></td>
                        <td colspan="2"><a class="ps-btn" href="{{ route('front.checkout') }}">Process to checkout<i class="ps-icon-next"></i></a></td>
                    </tr>
                </tbody>
              </table>
            </form>
          </div>
        </div>
      </div>
@endsection