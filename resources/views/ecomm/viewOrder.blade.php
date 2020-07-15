@extends('layout.ecomm')
@section('title')
    <title>Order {{ $order->invoice }}</title>
@endsection

@section('content')
    <main class="ps-main">
        <div class="container">
            <div class="row pt-5 pb-5">
               <div class="col-md-4 col-sm-12">
                  <div class="card">
                      <div class="card-header">
                          <div class="card-title">
                              <h4 class="text-center"><b>Data Pemesan</b></h4>
                          </div>
                      </div>
                      <h6>
                      <div class="card-body">
                          <table class="table">
                              <tr>
                                  <td width="30%">Nama</td>
                                  <td width="10%"> : </td>
                                  <td>{{ $order->pelanggan_nama }}</td>
                              </tr>
                              <tr>
                                  <td>Telephone</td>
                                  <td>  :  </td>
                                  <td>{{ $order->pelanggan_telephone }}</td>
                              </tr>
                              <tr>
                                  <td>Alamat</td>
                                  <td> : </td>
                                  <td>{{ $order->pelanggan_alamat }},
                                    {{ $order->kecamatan->nama }},<br> 
                                    {{ $order->kecamatan->kota->nama }},
                                    {{ $order->kecamatan->kota->provinsi->nama }}</td>
                              </tr>
                          </table>
                      </div>
                      </h6>
                  </div>
              </div>
              <div class="col-md-4 col-sm-12">
                  <div class="card">
                      <div class="card-header">
                          <div class="card-title">
                              <h4 class="text-center"><b>Data Barang</b></h4>
                          </div>
                      </div>
                      <div class="card-body"><h6>
                          <table class="table table-borderless">
                              <tr>
                                  <th>Produk</th>
                                  <th>Jumlah</th>
                                  <th>Harga</th>
                              </tr>
                            @forelse ($order->details as $row)
                              <tr>
                                  <td>{{ $row->produk->nama }}</td>
                                  <td>x {{ $row->jumlah }}</td>
                                  <td>{{ number_format($row->harga) }}</td>
                              </tr>
                            @empty
                              <tr>
                                  <td colspan="4" class="text-center">Tidak ada data</td>
                              </tr>
                            @endforelse
                          </table>
                      </h6></div>
                  </div>
               </div>
               <div class="col-md-4 col-sm-12">
                  <div class="card">
                      <div class="card-header">
                          <div class="card-title">
                              <h4 class="text-center"><b>Pembayaran</b></h4>
                          </div>
                      </div>
                      <div class="card-body"><h6>
                          @if ($order->pembayarans)
                          <table>
                              <tr>
                                  <td width="40%">Nama Pengirim</td>
                                  <td width="5%"></td>
                                  <td>{{ $order->pembayarans->name }}</td>
                              </tr>
                              <tr>
                                  <td>Tanggal Transfer</td>
                                  <td></td>
                                  <td>{{ $order->pembayarans->transfer_date }}</td>
                              </tr>
                              <tr>
                                  <td>Jumlah Transfer</td>
                                  <td></td>
                                  <td>Rp {{ number_format($order->pembayarans->amount) }}</td>
                              </tr>
                              <tr>
                                  <td>Tujuan Transfer</td>
                                  <td></td>
                                  <td>{{ $order->pembayarans->transfer_to }}</td>
                              </tr>
                              <tr>
                                  <td>Bukti Transfer</td>
                                  <td></td>
                                  <td>
                                      <img src="{{ asset('storage/pembayaran/' . $order->pembayarans->proof) }}" width="50px" height="50px" alt="">
                                      <a href="{{ asset('storage/pembayaran/' . $order->pembayarans->proof) }}" target="_blank">Lihat Detail</a>
                                  </td>
                              </tr>
                          </table>
                          @else
                              <h4 class="text-center">Belum ada data pembayaran</h4>
                          @endif
                      </h6></div>
                      @if ($order->status == 0)
                          <div class="card-footer">
                              <a href="{{ url('member/pembayaran?invoice=' . $order->invoice) }}" class="btn btn-primary btn-lg w-100 float-right">Konfirmasi</a>
                          </div>
                      @endif
                  </div>
               </div>
            </div>
        </div>
    </main>	
@endsection