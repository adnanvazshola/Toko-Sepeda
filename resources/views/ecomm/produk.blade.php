@extends('layout.ecomm')
@section('title')
    <title>Produk</title>
@endsection

@section('content')
  <main class="ps-main">
      <div class="ps-products-wrap pt-80 pb-80">
        <div class="ps-products" data-mh="product-listing">
          <div class="ps-product-action">
            {{-- <div class="ps-product__filter">
              <select class="ps-select selectpicker">
                <option value="2">Terbaru</option>
                <option value="3">Nama</option>
                <option value="4">Harga (Rendah to Tinggi)</option>
                <option value="5">Harga (Tinggi to Rendah)</option>
              </select>
            </div> --}}
            <div class="ps-pagination">
              <ul class="pagination">
                {{ $produk->links() }}
              </ul>
            </div>
          </div>
          <div class="ps-product__columns">
            @forelse ($produk as $row)
            <div class="ps-product__column">
              <div class="ps-shoe mb-30">
                <div class="ps-shoe__thumbnail">
                  {{-- <a class="ps-shoe__favorite" href="#">
                    <i class="ps-icon-heart"></i>
                  </a> --}}
                  <img src="{{ asset('storage/produk/' . $row->foto) }}" alt="" style="height: 200px;">
                  <a class="ps-shoe__overlay" href="#"></a>
                </div>
                <div class="ps-shoe__content">
                  <div class="ps-shoe__detail"><a class="ps-shoe__name" href="{{ url('/produk/' . $row->slug) }}">{{ $row->nama }} - {{ $row->warna->nama }}</a>
                    <p class="ps-shoe__categories">
                      <a href="#">{{ $row->kategori->nama }}</a>,
                      <a href="#">{{ $row->merk->nama }}</a>
                    </p>
                    <span class="ps-shoe__price">Rp. {{ number_format($row->harga) }}</span>
                  </div>
                </div>
              </div>
            </div>
            @empty
              <div class="col-md-12">
                <h3 class="text-center">Tidak ada produk</h3>
              </div>
            @endforelse
          </div>
        </div>
        <div class="ps-sidebar" data-mh="product-listing">
          <aside class="ps-widget--sidebar ps-widget--filter">
            <div class="ps-widget__header">
              <h3>Harga</h3>
            </div>
            <div class="ps-widget__content">
              <div class="ac-slider" data-default-min="0" data-default-max="100.000.000" data-max="3450" data-step="50" data-unit="Rp. "></div>
              <p class="ac-slider__meta">Price:<span class="ac-slider__value ac-slider__min"></span>-<span class="ac-slider__value ac-slider__max"></span></p><a class="ac-slider__filter ps-btn" href="#">Filter</a>
            </div>
          </aside>
          <aside class="ps-widget--sidebar ps-widget--category">
            <div class="ps-widget__header">
              <h3>Kategori</h3>
            </div>
            <div class="ps-widget__content">
              <ul class="ps-list--checked">
                @foreach ($kategori as $c)
                  <li>
                    <strong><a href="{{ url('/kategori/' . $c->slug) }}">{{ $c->nama }}</a></strong>
                  </li>
                  @foreach ($c->child as $child)
                    <li>
                      <a href="{{ url('/kategori/' . $child->slug) }}">{{ $child->nama }}</a>
                    </li>    
                  @endforeach
                @endforeach
              </ul>
            </div>
          </aside>
          <aside class="ps-widget--sidebar ps-widget--category">
            <div class="ps-widget__header">
              <h3>Merk</h3>
            </div>
            <div class="ps-widget__content">
              <ul class="ps-list--checked">
                @foreach ($merk as $m)
                    <li>
                      <a href="{{ url('/merk/' . $m->slug) }}">{{ $m->nama }}</a>
                    </li>
                  @endforeach
              </ul>
            </div>
          </aside>
          <div class="ps-sticky desktop">
            <aside class="ps-widget--sidebar">
              <div class="ps-widget__header">
                <h3>Ukuran</h3>
              </div>
              <div class="ps-widget__content">
                <table class="table ps-table--size">
                  <tbody>
                    <tr>
                      <td colspan="5" class="active">ALL SIZE</td>
                    </tr>
                    <tr>
                      <td>XS</td>
                      <td>S</td>
                      <td>M</td>
                      <td>L</td>
                      <td>XL</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </aside>
            {{-- <aside class="ps-widget--sidebar">
              <div class="ps-widget__header">
                <h3>Warna</h3>
              </div>
              <div class="ps-widget__content">
                <ul class="ps-list--color">
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                </ul>
              </div>
            </aside> --}}
          </div>
        </div>
      </div>
    </main>
@endsection