<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<div class="container-fluid" id="form-laporan">
    <div class="row">
        <div class="col-md-4">
            <a class="btn " data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><p class="fs-6 fw-bold">Pencarian Laporan Custom <i class="bi bi-chevron-down"></i></p></a>
        </div>
        <div class="col-md-4">
            <a class="btn" data-bs-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2"><p class="fs-6 fw-bold ">Pencarian Laporan Laporan Bulanan <i class="bi bi-chevron-down"></i></p></a>
        </div>
        <div class="col-md-4">
            <a class="btn" data-bs-toggle="collapse" href="#multiCollapseExample3" role="button" aria-expanded="false" aria-controls="multiCollapseExample3"><p class="fs-6 fw-bold">Pencarian Laporan Tahunan <i class="bi bi-chevron-down"></i></p></a>
        </div>
    </div>

    <form action="/laporan-labarugi" method="GET" enctype="multipart/form-data" class="justify-content-center align-items-center  ">
        <hr>
        <div class="collapse multi-collapse" id="multiCollapseExample1">
            <div class="card card-body">
                <div class="col-md-3">
                    <h6>Tanggal Awal</h6>
                    <input type="date" class="form-control form-control-md" id="tanggal_awal"
                        name="tanggal_awal">
                </div>
                <div class="col-md-3 mt-3">
                    <h6>Tanggal Akhir</h6>
                    <input type="date" class="form-control form-control-md" id="tanggal_akhir"
                        name="tanggal_akhir">

                </div>
                <div class="col-2">
                    <button class="btn btn-primary mt-4" name="cari-penjualan" id="cari-penjualan"> Cari</button>
                </div>
            </div>
        </div>
    </form>
    <form action="/laporan-labarugi-bulanan" method="GET" enctype="multipart/form-data">
        <div class="collapse multi-collapse" id="multiCollapseExample2">
            <div class="card card-body ">
                <div class="col-md-8 mb-2 ">
                    <h6>Masukkan Bulan Laporan</h6>
                    <input type="month" class="form-control form-control-md col-md-10" id="bulan_laporan"
                        name="bulan_laporan">
                </div>
                <div class="col-2">
                    <button class="btn btn-primary" name="cari-penjualan" id="cari-penjualan"> Cari</button>
                </div>
            </div>
        </div>
    </form>
    <form action="/laporan-labarugi-tahunan" method="GET" enctype="multipart/form-data">
        <div class="collapse multi-collapse" id="multiCollapseExample3">
            <div class="card card-body">
                <div class="col col-8 mb-2">
                    <h6>Masukkan Tahun Laporan</h6>
                    <input type="number" min="1999" max={{ $year }} type="Year"
                        class="form-control form-control-md col-md-10" id="tahun_laporan" name="tahun_laporan"
                        value={{ $year }} type="year">
                </div>
                <div class="col-2">
                    <button class="btn btn-primary" name="cari-penjualan" id="cari-penjualan"> Cari</button>
                </div>
            </div>
        </div>
    </form>
</div>

    <hr style="border: double">
    <div class="row justify-content-center">
            <div class="row col-md-12 d-flex mt-5">
                <div class="table-responsive-sm table-wrapper-scroll-y my-custom-scrollbar text-center">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('laporan.exportlabarugi', request()->query()) }}"
                                class="btn btn-success text-white py-2 ml-2">
                                <i class="bi bi-printer"></i>
                                <span>Export Laporan</span>
                            </a>
                            <table class="table table-bordered">
                                <thead style="background-color: #17a2b8">
                                    <tr>
                                        <th scope="col" colspan="7">
                                            <div class="row">
                                                <div class="card-body d-sm-flex justify-content-between">
                                                    <h6 class="col-md-7 mb-0">
                                                    </h6>
                                                    <h6 class="col-md-5 mb-0">
                                                    </h6>
                                                </div>
                                                <div class="col col-12">
                                                    <h3 class="text-center fw-bold">Laporan Laba Rugi</h3>
                                                </div>
                                                <div class="col col-12">
                                                    <h6 class="">
                                                        @empty($awal || $month || $tahunl)
                                                            -
                                                        @else
                                                            @if ($awal && $akhir)
                                                                Tanggal :
                                                                <?php
                                                                echo date('d F Y', strtotime($awal));
                                                                ?> - <?php
                                                                echo date('d F Y', strtotime($akhir));
                                                                ?>
                                                            @endif
                                                            @if ($month)
                                                                <?php
                                                                echo 'Bulan ' . date('F Y', strtotime($month));
                                                                ?>
                                                            @endif
                                                            @if ($tahunl)
                                                                Tahun {{ $tahunl }}
                                                            @endif
                                                        </h6>
                                                    @endempty
                                                </div>
                                            </div>

                                        </th>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <!-- <th scope="col">Pilihan</th> -->
                                        <th scope="col" class="fw-bold">No</th>
                                        <th scope="col" class="fw-bold">Nama Produk</th>
                                        <th scope="col" class="fw-bold">Harga Beli/satuan</th>
                                        <th scope="col" class="fw-bold">Harga Jual/satuan</th>
                                        <th scope="col" class="fw-bold">Jumlah Terjual</th>
                                        <th scope="col" class="fw-bold">Total Harga Beli</th>
                                        <th scope="col" class="fw-bold">Total Harga Jual</th>
                                    </tr>
                                </thead>
                                <tbody id="table-penjualan" name="table-penjualan">
                                    @php
                                        $no = 1;
                                    @endphp
                                    @empty($produk)
                                        <tr>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>-</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                    @else
                                        @if ($total == 0)
                                            <td>-</td>
                                            <td>-</td>
                                            <td class="text-right ">0</td>
                                            <td class="text-right ">0</td>
                                            <td>-</td>
                                            <td class="text-right ">0</td>
                                            <td class="text-right ">0</td>
                                        @else
                                            @foreach ($produk as $index => $data)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $data->nama_produk }}</td>
                                                    <td class="text-right ">Rp. <?php
                                                    $angka = $data->modal;
                                                    echo number_format($angka, 0, ',', '.');
                                                    ?></td>
                                                    <td class="text-right ">Rp. <?php
                                                    $angka = $data->harga;
                                                    echo number_format($angka, 0, ',', '.');
                                                    ?></td>
                                                    <td>{{ $data->jumlah_pesanan }}</td>
                                                    <td class="text-right ">Rp. <?php
                                                    $angka = $data->jumlah_modal;
                                                    echo number_format($angka, 0, ',', '.');
                                                    ?></td>
                                                    <td class="text-right ">Rp. <?php
                                                    $angka = $data->jumlah_harga;
                                                    echo number_format($angka, 0, ',', '.');
                                                    ?></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endempty
                                </tbody>
                                @if ($total == 0)
                                    <tfoot style="background-color: #17a2b8">
                                        <tr>
                                            <th scope="col" colspan="4">
                                                <h5 class="text-left fw-bold ml-5">Total</h5>
                                            </th>
                                            <th scope="col">
                                                <h6 class="text-center fw-bold">
                                                    0
                                                </h6>
                                            </th>
                                            <th scope="col">
                                                <h6 class="text-right fw-bold">
                                                    Rp. 0
                                                </h6>
                                            </th>
                                            <th scope="col">
                                                <h6 class="text-right fw-bold">
                                                    Rp. 0
                                                </h6>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th scope="col" colspan="5">
                                                <h5 class="text-left fw-bold ml-5">
                                                    Keuntungan
                                                </h5>
                                            </th>
                                            <th scope="col" colspan="2">
                                                Rp. <?php
                                                $angka1 = 0;
                                                $angka2= 0;
                                                $angka = 0;
                                                echo number_format($angka, 0, ',', '.');
                                                ?>
                                            </th>
                                        </tr>
                                    </tfoot>
                                @else
                                    <tfoot style="background-color: #17a2b8">
                                        <tr>
                                            <th scope="col" colspan="4">
                                                <h5 class="text-left fw-bold ml-5">Total</h5>
                                            </th>
                                            <th scope="col">
                                                <h6 class="text-center fw-bold">
                                                    {{ $total_terjual->jumlah_pesanan }}
                                                </h6>
                                            </th>
                                            <th scope="col">
                                                <h6 class="text-right fw-bold">
                                                    Rp. <?php
                                                    $angka = $total_modal->jumlah_modal;
                                                    echo number_format($angka, 0, ',', '.');
                                                    ?>
                                                </h6>
                                            </th>
                                            <th scope="col">
                                                <h6 class="text-right fw-bold">
                                                    Rp. <?php
                                                    $angka = $total_harga->harga_terjual;
                                                    echo number_format($angka, 0, ',', '.');
                                                    ?>
                                                </h6>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th scope="col" colspan="5">
                                                <h5 class="text-left fw-bold ml-5">
                                                    Keuntungan
                                                </h5>
                                            </th>
                                            <th scope="col" colspan="2">
                                                <h5 class="fw-bold">
                                                Rp. <?php
                                                $angka1 = $total_harga->harga_terjual;
                                                $angka2= $total_modal->jumlah_modal;
                                                $angka = $angka1 - $angka2;
                                                echo number_format($angka, 0, ',', '.');
                                                ?>
                                                </h5>
                                            </th>
                                        </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
