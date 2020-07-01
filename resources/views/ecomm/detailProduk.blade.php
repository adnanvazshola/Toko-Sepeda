@extends('layout.ecomm')
@section('title')
    <title>{{ $produk->nama }}</title>
@endsection

@section('content')
      <div class="test">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 "></div>
          </div>
        </div>
      </div>
      <div class="ps-product--detail pt-60">
        <div class="ps-container">
          <div class="row">
            <div class="col-lg-10 col-md-12 col-lg-offset-1">
              <div class="ps-product__thumbnail">
                <div class="ps-product__image">
                  <div class="item">
                    <img class="zoom" src="{{ asset('storage/produk/' . $produk->foto) }}" alt="{{ $produk->nama }}" data-zoom-image="{{ asset('storage/produk/' . $produk->foto) }}"></div>
                </div>
              </div>
              <div class="ps-product__thumbnail--mobile">
                <div class="ps-product__main-img">
                  <img src="{{ asset('storage/produk/' . $produk->foto) }}" alt="{{ $produk->nama }}">
                </div>
              </div>
              <div class="ps-product__info">
                <div class="ps-product__rating">
                  <select class="ps-rating">
                    <option value="1">1</option>
                    <option value="1">2</option>
                    <option value="1">3</option>
                    <option value="1">4</option>
                    <option value="2">5</option>
                  </select><a href="#">(Read all 8 reviews)</a>
                </div>
                <h1>{{ $produk->nama }} - {{ $produk->warna->nama }}</h1>
                <p class="ps-product__category">
                  <a href="#">{{ $produk->kategori->nama }}</a>,
                  <a href="#">{{ $produk->merk->nama }}</a>
                </p>
                <h3 class="ps-product__price">Rp. {{ number_format($produk->harga) }}</h3>
                <form action="{{ route('front.cart') }}" method="POST">
                @csrf
                    <div class="ps-product__block ps-product__size">
                      <input type="hidden" name="produk_id" value="{{ $produk->id }}" class="form-control">
                      <input type="hidden" name="weight" value="{{ $produk->weight }}" class="form-control">
                      <h4>Pilih Ukuran<a href="#">Size chart</a></h4>
                      <select class="ps-select selectpicker" name="ukuran" required="silahkan pilih ukuran">
                        <option disabled>Select Size</option>
                        <option value="XS">XS</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                      </select>
                      <div class="form-group">
                        <input name="qty" type="number" class="form-control" value="1" maxlength="12">
                      </div>
                    </div>
                    <div class="ps-product__shopping">
                      <div class="form-group">
                          <button class="ps-btn mb-10">
                              Add to cart
                              <i class="ps-icon-next"></i>
                          </button>
                          @if (session('success'))
                              <div class="alert alert-success mt-2">{{ session('success') }}</div>
                          @endif
                      </div>
                      <div class="ps-product__actions">
                          <a class="mr-10" href="#"><i class="ps-icon-heart"></i></a>
                          <a href="#"><i class="ps-icon-share"></i></a></div>
                    </div>
              </div>
              <div class="clearfix"></div>
              <div class="ps-product__content mt-50">
                <ul class="tab-list" role="tablist">
                  <li class="active">
                    <a href="#tab_01" aria-controls="tab_01" role="tab" data-toggle="tab">Deskripsi</a>
                  </li>
                  <li>
                    <a href="#tab_02" aria-controls="tab_02" role="tab" data-toggle="tab">Catatan Pembeli</a>
                  </li>
                </ul>
              </div>
              <div class="tab-content mb-60">
                <div class="tab-pane active" role="tabpanel" id="tab_01">
                  {!! $produk->desc !!}
                </div>
                <div class="tab-pane" role="tabpanel" id="tab_02">
                  <div class="form-group">
                      <textarea name="catatan" class="form-control" rows="6" placeholder="Catatan untuk pelapak"></textarea>
                  </div>
                  <div class="form-group">
                      <button class="ps-btn">
                          Add to cart
                          <i class="ps-icon-next"></i>
                      </button>
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection