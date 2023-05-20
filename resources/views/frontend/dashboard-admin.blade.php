@extends('layouts.frontend-admin')

@section('title')
    <h1>Dashboard</h1>
@endsection

@section('content')
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Produk Terjual <span>| Tahun {{ $tahun }}</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        @foreach ($jumlahproduk as $item)
                                            <h6>{{ $item->totalproduk }}</h6>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Pendapatan <span>| Tahun {{ $tahun }}</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cash"></i>
                                    </div>
                                    <div class="ml-2">
                                        @foreach ($jumlahpendapatan as $item)
                                            <p class="fs-4">Rp. <?php
                                            $angka = $item->totalpes;
                                            echo number_format($angka, 0, ',', '.');
                                            ?></p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-4">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Pengguna <span>| Tahun {{ $tahun }}</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        @foreach ($jumlahpengguna as $item)
                                            <h6>{{ $item->totalpeng }}</h6>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Customers Card -->

                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Statistik Pendapatan <span>/Bulan</span></h5>

                                <!-- Line Chart -->
                                <div id="pendapatanChart"></div>
                                <script src="https://code.highcharts.com/stock/highstock.js"></script>
                                <script>
                                    var totalspem = <?php echo json_encode($totalpemasukan); ?>;
                                    var totalspro = <?php echo json_encode($totalproduk); ?>;
                                    var bulans = <?php echo json_encode($bulan); ?>;
                                    var tahuns = <?php echo json_encode($tahun); ?>;
                                    Highcharts.chart('pendapatanChart', {
                                        title: {
                                            text: 'Statistik Data Penjualan ' + tahuns
                                        },
                                        xAxis: {
                                            categories: bulans,
                                        },

                                        yAxis: {
                                            title: {
                                                text: 'Total Keuangan'
                                            }
                                        },
                                        plotOptions: {
                                            series: {
                                                allowPointSelect: true
                                            }
                                        },
                                        series: [{
                                            name: 'Total Pendapatan',
                                            data: totalspem
                                        }],
                                    });
                                </script>
                                <!-- End Line Chart -->

                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Statistik Data Pesanan<span>/Bulan</span></h5>

                                <!-- Line Chart -->
                                <div id="produkChart"></div>
                                <script src="https://code.highcharts.com/stock/highstock.js"></script>
                                <script>
                                    var totalspem = <?php echo json_encode($totalpemasukan); ?>;
                                    var totalspro = <?php echo json_encode($totalproduk); ?>;
                                    var bulans = <?php echo json_encode($bulan); ?>;
                                    var tahuns = <?php echo json_encode($tahun); ?>;
                                    Highcharts.chart('produkChart', {
                                        title: {
                                            text: 'Statistik Data Pesanan ' + tahuns
                                        },
                                        xAxis: {
                                            categories: bulans,
                                        },

                                        yAxis: {
                                            title: {
                                                text: 'Total Pesanan'
                                            }
                                        },
                                        plotOptions: {
                                            series: {
                                                allowPointSelect: true
                                            }
                                        },
                                        series: [{
                                            name: 'Total Pesanan',
                                            data: totalspro
                                        }],
                                    });
                                </script>
                                <!-- End Line Chart -->

                            </div>
                        </div>
                    </div><!-- End Reports -->

                </div>
            </div>
            <div class="col-lg-4">
                <!-- Recent Activity -->
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Pesanan <span>| Semua</span></h5>
                        <div class="d-flex align-items-center">
                            <p class="fs-5 bi bi-check2-all text-success ml-5"> Selesai</p>
                            @foreach ($jumlahSelesai as $item)
                                <p class="col text-right mr-5 text-success fs-5 fw-bold"> {{ $item->total }}</p>
                            @endforeach
                        </div>
                        <hr class="p-1 m-1">
                        <div class="d-flex align-items-center">
                            <p class="fs-5 bi bi bi-handbag-fill text-primary ml-5"> Dapat Diambil</p>
                            @foreach ($jumlahDiambil as $item)
                                <p class="col text-right mr-5 text-primary fs-5 fw-bold"> {{ $item->total }}</p>
                            @endforeach
                        </div>
                        <hr class="p-1 m-1">
                        <div class="d-flex align-items-center">
                            <p class="fs-5 bi bi-hourglass-split text-info ml-5"> Sedang Diproses</p>
                            @foreach ($jumlahProses as $item)
                                <p class="col text-right mr-5 text-info fs-5 fw-bold"> {{ $item->total }}</p>
                            @endforeach
                        </div>
                        <hr class="p-1 m-1">
                        <div class="d-flex align-items-center">
                            <p class="fs-5 bbi bi-exclamation-triangle text-warning ml-5"> Ditangguhkan</p>
                            @foreach ($jumlahTangguh as $item)
                                <p class="col text-right mr-5 text-warning fs-5 fw-bold"> {{ $item->total }}</p>
                            @endforeach
                        </div>
                        <hr class="p-1 m-1">
                        <div class="d-flex align-items-center">
                            <p class="fs-5 bi bi-x-square-fill text-danger ml-5"> Dibatalkan</p>
                            @foreach ($jumlahBatal as $item)
                                <p class="col text-right mr-5 text-danger fs-5 fw-bold"> {{ $item->total }}</p>
                            @endforeach
                        </div>
                    </div>
                </div><!-- End Recent Activity -->

                <!-- Budget Report -->
                <div class="card">
                    <div class="card-body pb-0">
                        <h5 class="card-title">Pesanan Harian <span>| {{ $date }}</span></h5>
                        <table class="table table-bordered col-12" id="list" style="min-height: 300px">
                            <thead>
                                <tr>
                                    <th scope="col" class="">No</th>
                                    <th scope="col" class="">Nama Pemesan</th>
                                    <th scope="col" class="">Total Harga</th>
                                    <th scope="col" class="">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($pesanan_harian)
                                    <tr>
                                        <td colspan="4" class="card-title text-center fs-5" >
                                            <span  style="font-style: italic">Pesanan Hari Ini Masih Kosong</span>
                                        </td>
                                    </tr>
                                @else
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($pesanan_harian as $index => $data)
                                        <tr>
                                            <td>{{ $index + $pesanan_harian->firstItem() }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>Rp. <?php
                                            $angka = $data->total_harga;
                                            echo number_format($angka, 0, ',', '.');
                                            ?></td>
                                            <td><small>{{ $data->status }}</small></td>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                        {{ $pesanan_harian->links() }}
                    </div>
                </div><!-- End Budget Report -->
            </div><!-- End Right side columns -->
        @endsection
