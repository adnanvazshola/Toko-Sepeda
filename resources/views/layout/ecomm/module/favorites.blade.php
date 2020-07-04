<section class="login_box_area p_120">
    <div class="container">
        <div class="column">
            <div class="col-md-3">
                @include('layout.ecomm.module.sidebar')
            </div>
            <h1><b>Daftar Favorites</h1><br/>
            <div class="col-md-9">

                {{-- <div class="shop-page-wrapper shop-page-padding ptb-100">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3">
                                {{-- @include('themes.ezone.partials.user_menu') --}}
                            {{-- </div>
                            <div class="col-lg-9"> --}}
                                {{-- @include('admin.partials.flash') --}}
                                {{-- <div class="shop-product-wrapper res-xl">
                                    <div class="table-content table-responsive">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>remove</th>
                                                    <th>Image</th>
                                                    <th>Produk</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($orders as $favorite)
                                                    @php
                                                        $produk = $favorite->produk;
                                                        $produk = isset($produk->parent) ?: $produk; --}}
                                                        // $image = !empty($produk->productImages->first()) ? asset('storage/'.$produk->productImages->first()->small) : asset('themes/ezone/assets/img/cart/3.jpg')
                                                    @endphp
                                                    <tr>
                                                        {{-- <td class="product-remove">
                                                            {!! Form::open(['url' => 'favorites/'. $favorite->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
                                                            {!! Form::hidden('_method', 'DELETE') !!}
                                                            <button type="submit" style="background-color: transparent; border-color: #FFF;">X</button>
                                                            {!! Form::close() !!}
                                                        </td> --}}
                                                        {{-- <td class="product-thumbnail">
                                                            <a href="{{ url('produk/'. $produk->slug) }}"><img src="{{ $image }}" alt="{{ $produk->name }}" style="width:100px"></a>
                                                        </td>
                                                        <td class="product-name"><a href="{{ url('produk/'. $produk->slug) }}">{{ $produk->name }}</a></td>
                                                        <td class="product-price-cart"><span class="amount">{{ number_format($produk->priceLabel()) }}</span></td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4">You have no favorite produk</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="mt-50 text-center">
                                    {{ $orders->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
</section>
