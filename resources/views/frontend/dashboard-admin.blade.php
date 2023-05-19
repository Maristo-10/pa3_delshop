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
                        <h5 class="card-title">Pesanan <span></span></h5>
                        <div class="d-flex align-items-center">
                            <p class="fs-5 bi bi-check2-all text-success ml-5"> Selesai</p>
                            @foreach ($jumlahSelesai as $item)
                            <p class="col text-right mr-5 text-success fs-5 fw-bold"> {{ $item->total}}</p>
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
                            <p class="col text-right mr-5 text-info fs-5 fw-bold"> {{$item->total}}</p>
                            @endforeach
                        </div>
                        <hr class="p-1 m-1">
                        <div class="d-flex align-items-center">
                            <p class="fs-5 bbi bi-exclamation-triangle text-warning ml-5"> Ditangguhkan</p>
                            @foreach ($jumlahTangguh as $item)
                            <p class="col text-right mr-5 text-warning fs-5 fw-bold"> {{$item->total}}</p>
                            @endforeach
                        </div>
                        <hr class="p-1 m-1">
                        <div class="d-flex align-items-center">
                            <p class="fs-5 bi bi-x-square-fill text-danger ml-5"> Dibatalkan</p>
                            @foreach ($jumlahBatal as $item)
                            <p class="col text-right mr-5 text-danger fs-5 fw-bold"> {{$item->total}}</p>
                            @endforeach
                        </div>
                    </div>
                </div><!-- End Recent Activity -->

                <!-- Budget Report -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body pb-0">
                        <h5 class="card-title">Budget Report <span>| This Month</span></h5>

                        <div id="budgetChart" style="min-height: 400px;" class="echart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                                    legend: {
                                        data: ['Allocated Budget', 'Actual Spending']
                                    },
                                    radar: {
                                        // shape: 'circle',
                                        indicator: [{
                                                name: 'Sales',
                                                max: 6500
                                            },
                                            {
                                                name: 'Administration',
                                                max: 16000
                                            },
                                            {
                                                name: 'Information Technology',
                                                max: 30000
                                            },
                                            {
                                                name: 'Customer Support',
                                                max: 38000
                                            },
                                            {
                                                name: 'Development',
                                                max: 52000
                                            },
                                            {
                                                name: 'Marketing',
                                                max: 25000
                                            }
                                        ]
                                    },
                                    series: [{
                                        name: 'Budget vs spending',
                                        type: 'radar',
                                        data: [{
                                                value: [4200, 3000, 20000, 35000, 50000, 18000],
                                                name: 'Allocated Budget'
                                            },
                                            {
                                                value: [5000, 14000, 28000, 26000, 42000, 21000],
                                                name: 'Actual Spending'
                                            }
                                        ]
                                    }]
                                });
                            });
                        </script>

                    </div>
                </div><!-- End Budget Report -->

                <!-- Website Traffic -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body pb-0">
                        <h5 class="card-title">Website Traffic <span>| Today</span></h5>

                        <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                echarts.init(document.querySelector("#trafficChart")).setOption({
                                    tooltip: {
                                        trigger: 'item'
                                    },
                                    legend: {
                                        top: '5%',
                                        left: 'center'
                                    },
                                    series: [{
                                        name: 'Access From',
                                        type: 'pie',
                                        radius: ['40%', '70%'],
                                        avoidLabelOverlap: false,
                                        label: {
                                            show: false,
                                            position: 'center'
                                        },
                                        emphasis: {
                                            label: {
                                                show: true,
                                                fontSize: '18',
                                                fontWeight: 'bold'
                                            }
                                        },
                                        labelLine: {
                                            show: false
                                        },
                                        data: [{
                                                value: 1048,
                                                name: 'Search Engine'
                                            },
                                            {
                                                value: 735,
                                                name: 'Direct'
                                            },
                                            {
                                                value: 580,
                                                name: 'Email'
                                            },
                                            {
                                                value: 484,
                                                name: 'Union Ads'
                                            },
                                            {
                                                value: 300,
                                                name: 'Video Ads'
                                            }
                                        ]
                                    }]
                                });
                            });
                        </script>

                    </div>
                </div><!-- End Website Traffic -->

                <!-- News & Updates Traffic -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body pb-0">
                        <h5 class="card-title">News &amp; Updates <span>| Today</span></h5>

                        <div class="news">
                            <div class="post-item clearfix">
                                <img src="assets/img/news-1.jpg" alt="">
                                <h4><a href="#">Nihil blanditiis at in nihil autem</a></h4>
                                <p>Sit recusandae non aspernatur laboriosam. Quia enim eligendi sed ut harum...</p>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/news-2.jpg" alt="">
                                <h4><a href="#">Quidem autem et impedit</a></h4>
                                <p>Illo nemo neque maiores vitae officiis cum eum turos elan dries werona nande...</p>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/news-3.jpg" alt="">
                                <h4><a href="#">Id quia et et ut maxime similique occaecati ut</a></h4>
                                <p>Fugiat voluptas vero eaque accusantium eos. Consequuntur sed ipsam et totam...</p>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/news-4.jpg" alt="">
                                <h4><a href="#">Laborum corporis quo dara net para</a></h4>
                                <p>Qui enim quia optio. Eligendi aut asperiores enim repellendusvel rerum cuder...</p>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/news-5.jpg" alt="">
                                <h4><a href="#">Et dolores corrupti quae illo quod dolor</a></h4>
                                <p>Odit ut eveniet modi reiciendis. Atque cupiditate libero beatae dignissimos eius...</p>
                            </div>

                        </div><!-- End sidebar recent posts-->

                    </div>
                </div><!-- End News & Updates -->

            </div><!-- End Right side columns -->
        @endsection
