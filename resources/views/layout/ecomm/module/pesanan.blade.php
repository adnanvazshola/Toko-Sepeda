<section class="login_box_area p_120">
    <div class="container">
        <div class="column">
            <div class="col-md-3">
                @include('layout.ecomm.module.sidebar')
            </div>
            <h1><b>Riwayat Pesanan</h1><br/>
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
        <br>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">List Pesanan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>invoice</th>
                                <th>Penerima</th>
                                <th>No Telp</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($order as $row)
                                <tr>
                                    <td><strong>{{ $row->invoice }}</strong></td>
                                    <td>{{ $row->pelanggan_nama }}</td>
                                    <td>{{ $row->pelanggan_telephone }}</td>
                                    <td>{{ number_format($row->subtotal) }}</td>
                                    <td>{!! $row->status_label !!}</td>
                                    <td>{{ $row->created_at }}</td>
                                    <td>
                                        <a href="{{ route('pelanggan.view_order', $row->invoice) }}" class="btn btn-primary btn-sm">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada pesanan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="float-right">
                    {!! $order->links() !!}
                </div>
            </div>
        </div>
    </div>
</section>
