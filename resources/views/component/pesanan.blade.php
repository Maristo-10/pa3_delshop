<!-- Page Header Start -->
<div class="container-fluid ">
    <div class="row px-xl-5 mt-3">
        <div class="col-lg">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="container">
    <div class=" col 12 card-body d-flex justify-content-center text-center">
    <h6 class="col-md-12 mb-0">
        <a href="/pesanan" class="bi bi-filter-circle btn btn-dark text-white py-2 ml-2 fs-6 mt-3" name="btn-dibatalkan"
            id="btn-dibatalkan" title="Semua Pesanan">
            <span class="d-none d-xl-inline align-items-center fs-6">Semua</span>
        </a>
        <a href="/pesanan-dibatalkan" class=" bi bi-x-square-fill btn btn-danger text-white py-2 ml-2 col-2 fs-6 mt-3"
            name="btn-dibatalkan" id="btn-dibatalkan" title="Pesanan Dibatalkan">
            <span class="d-none d-xl-inline align-items-center fs-6">Dibatalkan</span>
        </a>
        <a href="/pesanan-ditangguhkan"
            class=" bi bi-exclamation-triangle btn btn-warning text-white py-2 ml-2 col-2 fs-6 mt-3" name="btn-ditangguhkan"
            id="btn-ditangguhkan" title="Pesanan Belum Dibayar">
            <span class="d-none d-xl-inline align-items-center fs-6">Belum Dibayar</span>
        </a>
        <a href="/pesanan-diproses" class="bi bi-hourglass-split btn btn-info text-white py-2 ml-2 col-2 fs-6 mt-3"
            name="btn-diproses" id="btn-diproses" title="Pesanan Sedang Diproses">
            <span class="d-none d-xl-inline align-items-center fs-6">Sedang Diproses</span>
        </a>
        <a href="/pesanan-belum" class="bi bi bi-handbag-fill btn btn-primary text-white py-2 ml-2 col-2 fs-6 mt-3"
            name="btn-belum" id="btn-belum" title="Pesanan Dapat Diambil">
            <span class="d-none d-xl-inline align-items-center fs-6">Dapat Diambil</span>
        </a>
        <a href="/pesanan-selesai" class="bi bi-check2-all btn btn-success text-white py-2 ml-2 col-2 fs-6 mt-3"
            name="btn-selesai" id="btn-selesai" title="Pesanan Selesai">
            <span class="d-none d-xl-inline align-items-center fs-6">Selesai</span>
        </a>
    </h6>
</div>
</div>
<div class="col-md-12 mt-3 text-center">
    <h3>Riwayat Pesanan</h3>
</div>
<!-- Page Header End -->
<div class="col-12 shadow-sm rounded mt-3 bg-white p-3">
    <div class="col-12 mt-1" style="justify-content:center;align-items:center;display:flex">
        <div class="table-responsive-sm table-wrapper-scroll-y my-custom-scrollbar col-md-11 text-center">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table  table-bordered" id="list">
                            <thead>
                                <tr>
                                    <!-- <th scope="col">Pilihan</th> -->
                                    <th scope="col" class="">No</th>
                                    <th scope="col" class="">Tanggal Pesanan</th>
                                    <th scope="col" class="">Total Harga</th>
                                    <th scope="col" class="">Nama Pengambil</th>
                                    <th scope="col" class="">Metode Pembayaran</th>
                                    <th scope="col" class="">Nama Layanan</th>
                                    <th scope="col" class="">Status</th>
                                    <th scope="col" class="">Aksi</th>
                                    <!-- <th scope="col">Lampiran</th> -->
                                </tr>
                            </thead>
                            <tbody id="table-pesanan" name="table-pesanan">
                                @php
                                    $no = 1;
                                @endphp
                                @if (count($pesanan_kapem) == 0)
                                <tr>
                                    <td colspan="8" class="text-muted mt-3">
                                        <i class="bi bi-cart-fill fs-1 "></i>
                                        <p class="fs-1">Data Pesanan Anda Kosong</p></td>
                                </tr>

                                @else
                                    @foreach ($pesanan_kapem as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->tanggal }}</td>
                                            <td>Rp. <?php
                                            $angka = $data->total_harga;
                                            echo number_format($angka, 0, ',', '.');
                                            ?></td>
                                            <td>{{ $data->nama_pengambil }}</td>
                                            <td>{{ $data->kapem }}</td>
                                            <td>{{ $data->layanan }}</td>
                                            <td><b>{{ $data->status }}</b></td>
                                            <td>
                                                <a href="/detail-pesanan/{{ $data->id }}" title="Lihat Detail Pesanan"
                                                    class="bi bi-eye btn btn-secondary" style="font-size: 15px"></a>
                                                <a href="/batalkan-pesanan-pembeli/{{$data->id}}" title="Batalkan Pesanan"
                                                    class="bi bi-x-lg btn btn-danger ml-2" style="font-size: 15px"></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="row">
                            <div class="col-md-12">
                                {{ $pesanan_kapem->links('pagination::tailwind') }}
                            </div>
                        </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
