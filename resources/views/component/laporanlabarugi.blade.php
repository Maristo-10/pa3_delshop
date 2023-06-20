<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<div class="container-fluid" id="form-laporan">
    <form action="/laporan-labarugi" method="GET" enctype="multipart/form-data">
        <a class="" data-bs-target="#laporan-custom" data-bs-toggle="collapse">
            <h5 class="fw-bold">Pencarian Laporan Custom <i class="bi bi-chevron-down ml-2"></i></h5>
        </a>
        <hr>
        <div class="row nav-content collapse " id="laporan-custom" data-bs-parent="#form-laporan">
            <div class="col col-4">
                <h6>Tanggal Awal</h6>
                <input type="date" class="form-control form-control-md col-md-10" id="tanggal_awal"
                    name="tanggal_awal">
            </div>
            <div class="col col-4 mb-5">
                <h6>Tanggal Akhir</h6>
                <input type="date" class="form-control form-control-md col-md-10" id="tanggal_akhir"
                    name="tanggal_akhir">
            </div>
            <div class="col-2">
                <button class="btn btn-primary mt-4" name="cari-penjualan" id="cari-penjualan"> Cari</button>
            </div>
        </div>
    </form>
    <form action="/laporan-labarugi-bulanan" method="GET" enctype="multipart/form-data">
        <a class="" data-bs-target="#components-laporan-bulanan" data-bs-toggle="collapse">
            <h5 class="fw-bold">Pencarian Laporan Bulanan <i class="bi bi-chevron-down ml-2"></i></h5>
        </a>
        <hr>
        <div class="row nav-content collapse " id="components-laporan-bulanan" data-bs-parent="#form-laporan">
            <div class="col col-4 mb-5">
                <h6>Masukkan Bulan Laporan</h6>
                <input type="month" class="form-control form-control-md col-md-10" id="bulan_laporan"
                    name="bulan_laporan">
            </div>
            <div class="col-2">
                <button class="btn btn-primary mt-4" name="cari-penjualan" id="cari-penjualan"> Cari</button>
            </div>
        </div>
    </form>
    <form action="/laporan-labarugi-tahunan" method="GET" enctype="multipart/form-data">
        <a class="" data-bs-target="#components-laporan-tahunan" data-bs-toggle="collapse">
            <h5 class="fw-bold">Pencarian Laporan Tahunan <i class="bi bi-chevron-down ml-2"></i></h5>
        </a>
        <hr>
        <div class="row nav-content collapse " id="components-laporan-tahunan" data-bs-parent="#form-laporan">
            <div class="col col-4 mb-5">
                <h6>Masukkan Tahun Laporan</h6>
                <input type="number" min="1999" max={{ $year }} type="Year"
                    class="form-control form-control-md col-md-10" id="tahun_laporan" name="tahun_laporan"
                    value={{ $year }} type="year">
            </div>
            <div class="col-2">
                <button class="btn btn-primary mt-4" name="cari-penjualan" id="cari-penjualan"> Cari</button>
            </div>
        </div>
    </form>
    <hr style="border: double">
    <div class="row justify-content-center">
        <center>
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
                                                        {{-- <a href="/tambahproduk" class="btn btn-success text-white py-2 ml-2">
                                                            <i class="fa fa-plus"></i>
                                                            <span>Tambah Data Produk</span>
                                                        </a> --}}
                                                    </h6>
                                                    <h6 class="col-md-5 mb-0">
                                                        {{-- <a href="export/laporanpenjualan" class="btn btn-success text-white py-2 ml-2">
                                                            <i class="bi bi-printer"></i>
                                                            <span>Export Penjualan</span>
                                                        </a> --}}


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
        </center>

    </div>
</div>
