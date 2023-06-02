<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<div class="container-fluid" id="form-laporan">
    <form action="/laporan-custom" method="GET" enctype="multipart/form-data">
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
    <form action="/laporan-bulanan" method="GET" enctype="multipart/form-data">
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
    <form action="/laporan-tahunan" method="GET" enctype="multipart/form-data">
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
            <div class="row col-md-9 d-flex mt-5">

                <div class="table-responsive-sm table-wrapper-scroll-y my-custom-scrollbar text-center">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('laporan.export', request()->query()) }}" class="btn btn-success text-white py-2 ml-2">
                                <i class="bi bi-printer"></i>
                                <span>Export Penjualan</span>
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
                                                    <h3 class="text-center fw-bold" style="color: white">Laporan
                                                        Penjualan</h3>
                                                </div>
                                                <div class="col col-12">
                                                    <h6 class="" style="color: white">
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
                                        <th scope="col" class="fw-bold">Tanggal Pesanan</th>
                                        <th scope="col" class="fw-bold">Nama Pengambil</th>
                                        <th scope="col" class="fw-bold">Jumlah Produk</th>
                                        <th scope="col" class="fw-bold">Metode Pembayaran</th>
                                        <th scope="col" class="fw-bold">Nama Layanan</th>
                                        <th scope="col" class="fw-bold">Total Harga</th>

                                    </tr>
                                </thead>
                                <tbody id="table-penjualan" name="table-penjualan">
                                    @php
                                        $no = 1;
                                    @endphp
                                    @empty($penjualan)
                                        <tr>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>0</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td style="text-align: right">Rp. 0</td>
                                        </tr>
                                    @else
                                        @foreach ($penjualan as $index => $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data->tanggal }}</td>
                                                <td>{{ $data->nama_pengambil }}</td>
                                                <td>{{ $jlh_pesanan->total }}</td>
                                                <td>{{ $data->kapem }}</td>
                                                <td>{{ $data->layanan }}</td>
                                                <td style="text-align: right">Rp. <?php
                                                $angka = $data->total_harga;
                                                echo number_format($angka, 0, ',', '.');
                                                ?></td>
                                            </tr>
                                        @endforeach
                                    @endempty
                                </tbody>
                                <tfoot style="background-color: #17a2b8">
                                    <tr>
                                        @empty($penjualan)
                                            <th scope="col" colspan="4">
                                                <h6 class="text-right fw-bold mr-3" style="color: white">Jumlah Produk
                                                    Terjual:
                                                    0 Produk
                                                </h6>
                                            </th>
                                        @else
                                            <th scope="col" colspan="4">
                                                <h6 class="text-right fw-bold mr-3" style="color: white">Jumlah Produk
                                                    Terjual:
                                                    {{ $jlh_pesanan->total }} Produk
                                                </h6>
                                            </th>
                                        @endempty
                                        <th scope="col" colspan="3">
                                            <h6 class="text-right fw-bold" style="color: white">Total Pendapatan: Rp.
                                                <?php
                                                $angka = $total_harga->total;
                                                echo number_format($angka, 0, ',', '.');
                                                ?>
                                            </h6>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </center>

    </div>
</div>

<!-- Bootstrap JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>


{{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#cari-penjualan').on('click', function() {
                var tanggalAwal = document.getElementById('tanggal_awal').value;
                var tanggalAkhir = document.getElementById('tanggal_akhir').value;
                console.log(tanggalAwal);
                console.log(tanggalAkhir);
                $('#table-penjualan').html('');
                $.ajax({
                    url: '{{ route('getPenjualan') }}',
                    type: 'get',
                    success: function(res) {
                        $('table-penjualan').html(' ');
                        $no = 1;
                        $.each(res, function(key, value) {
                            $('table-penjualan').append('<tr>');
                        $('table-penjualan').append('<td>' + 1 + '</td>');
                        $('table-penjualan').append('<td>' + value.tanggal +
                            '</td>');
                        // var number_string = value.total_harga.toString(),
                        //     sisa = number_string.length % 3,
                        //     rupiah = number_string.substr(0, sisa),
                        //     ribuan = number_string.substr(sisa).match(/\d{3}/g);

                        // if (ribuan) {
                        //     separator = sisa ? '.' : '';
                        //     rupiah += separator + ribuan.join('.');
                        // }
                        $('table-penjualan').append('<td>' + 'Rp. ' + value.total_harga +
                            '</td>');
                        $('table-penjualan').append(
                            '<td>' + value.nama_pengambil + '</td>');
                        $('table-penjualan').append(
                            '<td>' + value.kategori_pembayaran + '</td>');
                        $('table-penjualan').append(
                            '<td>' + value.nama_layanan + '</td>');
                            $('table-penjualan').append(
                            "<td><img src='/pembayaran-images/" + value
                            .bukti_pembayaran +
                            "'style='max-height: 50px'></td>");
                        $('table-penjualan').append('</tr>');
                        });
                    }
                });
            });
        });
    </script> --}}
