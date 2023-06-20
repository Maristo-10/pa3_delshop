@extends('layouts.frontend-admin')

@section('title')
    <h1 class="fs-1">Dashboard</h1>
@endsection

@section('content')
    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Produk Terjual <span>| {{ $tahun }}</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart "></i>
                                    </div>
                                    <div class="ps-3">
                                        @foreach ($jumlahproduk as $item)
                                            <p class="fs-3">{{ $item->totalproduk }}</p>
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
                                <h5 class="card-title">Pendapatan <span>|{{ $tahun }}</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cash"></i>
                                    </div>
                                    <div class="ml-3">
                                        @foreach ($jumlahpendapatan as $item)
                                            <p class="fs-3">Rp.<?php
                                            $angka = $item->totalpes;
                                            echo number_format($angka, 0, ',', '.');
                                            ?></p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Revenue Card -->
                    @if ($pesanan_datang > 0)
                        <div class="col-xxl-4 col-md-4">
                            <div class="card info-card">
                                <div class="card-body my-3">
                                    <div class="d-flex align-items-center">
                                        <p class="bi bi-info-circle fs-5"> Informasi</p>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="bi bi-bell fs-1 text-primary blink-icon"></i>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center fs-6">
                                        <p> {{ $pesanan_datang }} Pesanan Baru</p>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center fs-6 mt-2">
                                        <a href="kelola-pesanan" class="btn btn-primary">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

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
                            <p class="fs-6 bi bi-check2-all text-success ml-2"> Selesai</p>
                            @foreach ($jumlahSelesai as $item)
                                <p class="col text-right mr-5 text-success fs-6 fw-bold"> {{ $item->total }}</p>
                            @endforeach
                        </div>
                        <hr class="p-1 m-1">
                        <div class="d-flex align-items-center">
                            <p class="fs-6 bi bi bi-handbag-fill text-primary ml-2"> Dapat Diambil</p>
                            @foreach ($jumlahDiambil as $item)
                                <p class="col text-right mr-5 text-primary fs-6 fw-bold"> {{ $item->total }}</p>
                            @endforeach
                        </div>
                        <hr class="p-1 m-1">
                        <div class="d-flex align-items-center">
                            <p class="fs-6 bi bi-hourglass-split text-info ml-2"> Sedang Diproses</p>
                            @foreach ($jumlahProses as $item)
                                <p class="col text-right mr-5 text-info fs-6 fw-bold"> {{ $item->total }}</p>
                            @endforeach
                        </div>
                        <hr class="p-1 m-1">
                        <div class="d-flex align-items-center">
                            <p class="fs-6 bbi bi-exclamation-triangle text-warning ml-2"> Ditangguhkan</p>
                            @foreach ($jumlahTangguh as $item)
                                <p class="col text-right mr-5 text-warning fs-6 fw-bold"> {{ $item->total }}</p>
                            @endforeach
                        </div>
                        <hr class="p-1 m-1">
                        <div class="d-flex align-items-center">
                            <p class="fs-6 bi bi-x-square-fill text-danger ml-2"> Dibatalkan</p>
                            @foreach ($jumlahBatal as $item)
                                <p class="col text-right mr-5 text-danger fs-6 fw-bold"> {{ $item->total }}</p>
                            @endforeach
                        </div>
                    </div>
                </div><!-- End Recent Activity -->

                <!-- Budget Report -->
                <div class="card">
                    <div class="card-body pb-0" style="min-height: 400px">
                        <h5 class="card-title">Pesanan Harian <span>| {{ $date }}</span></h5>
                        <table class="table table-bordered col-12" id="list">
                            <thead>
                                <tr>
                                    <th scope="col" class="">No</th>
                                    <th scope="col" class="">Nama Pemesan</th>
                                    <th scope="col" class="">Detail Pesanan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @empty($pesanan_harian)
                                    <tr>
                                        <td colspan="4" class="card-title text-center fs-5">
                                            <span style="font-style: italic">Pesanan Kosong</span>
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
                                            <td>
                                                <a class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $data->id }}">
                                                    <i class="bi bi-info-square fs-6"></i>
                                                </a>
                                            </td>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="form-label">ID
                                                                    Pesanan</label>
                                                                <input type="text" id="disabledTextInput"
                                                                    class="form-control" placeholder="{{ $data->kode }}"
                                                                    disabled>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="form-label">Nama
                                                                    Pesanan</label>
                                                                <input type="text" id="disabledTextInput"
                                                                    class="form-control" placeholder="{{ $data->name }}"
                                                                    disabled>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="form-label">Nama
                                                                    Pengambil</label>
                                                                <input type="text" id="disabledTextInput"
                                                                    class="form-control"
                                                                    placeholder="{{ $data->nama_pengambil }}" disabled>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="form-label">Total
                                                                    Pesanan</label>
                                                                <input type="text" id="disabledTextInput"
                                                                    class="form-control" placeholder="Rp. <?php $angka = $data->total_harga;
                                                                    echo number_format($angka, 0, ',', '.');
                                                                    ?>"
                                                                    disabled>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1"
                                                                    class="form-label">Status</label>
                                                                <input type="text" id="disabledTextInput"
                                                                    class="form-control" placeholder="{{ $data->status }}"
                                                                    disabled>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
                                @endempty
                            </tbody>
                        </table>
                        {{ $pesanan_harian->links() }}
                    </div>
                </div><!-- End Budget Report -->

            </div><!-- End Right side columns -->
        @endsection
