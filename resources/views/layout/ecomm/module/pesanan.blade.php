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
    </div>
</section>
