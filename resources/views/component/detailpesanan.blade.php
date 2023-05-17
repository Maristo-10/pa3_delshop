<!-- Page Header Start -->
@if (Auth::user()->role_pengguna == 'Publik')
    <div class="container-fluid ">
        <div class="row px-xl-5 mt-3">
            <div class="col-lg">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item"><a href="/pesanan">Pesanan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Pesanan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endif
<!-- Page Header End -->
<!-- Navbar Start -->
@php
    $no = 1;
@endphp

<style type="text/css">
    /* @media (min-width: 1025px) {
        .h-custom {
            height: 100vh !important;
        }
    } */

    /* .card-registration .select-input.form-control[readonly]:not([disabled]) {
        font-size: 1rem;
        line-height: 2.15;
        padding-left: .75em;
        padding-right: .75em;
    }

    .card-registration .select-arrow {
        top: 13px;
    }

    .bg-grey {
        background-color: #eae8e8;
    } */
/*
    @media (min-width: 992px) {
        .card-registration-2 .bg-grey {
            border-top-right-radius: 16px;
            border-bottom-right-radius: 16px;
        }
    }

    @media (max-width: 991px) {
        .card-registration-2 .bg-grey {
            border-bottom-left-radius: 16px;
            border-bottom-right-radius: 16px;
        }
    } */
</style>
<div class="container-fluid py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-11">
            @foreach ($pembayaran as $data)
                @if (Route::is('admin.ubahstatus', $data->id))
                    <div class="card card-registration card-registration-2 col-4  d-flex justify-content-center"
                        style="border-radius: 15px;">
                        <form action="/proses/ubah/status/{{$data->id}}" method="POST">
                            @csrf
                            <div class="card-body p-4">
                                <div class="row mb-3">
                                    <small class="col col-5 mt-1" style="font-weight: bold">Status Pesanan : </small>
                                    <select class="col form-control form-control-sm" name="status"
                                        id="status" style="font-weight: bold">
                                        @foreach ($pembayaran as $data)
                                            <option selected disabled>{{ $data->status }}</option>
                                        @endforeach
                                        <option value="Ditangguhkan">Ditangguhkan</option>
                                        <option value="Dibatalkan">Dibatalkan</option>
                                        <option value="Diproses">Diproses</option>
                                        <option value="Siap Diambil">Siap Diambil</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                </div>
                                <div class="row mb-1 float-center">
                                    <button type="submit" class="col btn btn-warning btn-sm col-sm-12">Ubah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            @endforeach


            <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-lg-8">
                            <div class="p-5">
                                <div class="d-flex justify-content-between align-items-center mb-5">
                                    <h1 class="fw-bold mb-0 text-black">Detail Produk</h1>
                                    <h6 class="mb-0 text-muted">{{ $jumlah_pesanan->total }} Produk</h6>
                                </div>

                                <hr class="my-3">
                                <div class="row d-flex justify-content-between align-items-center"
                                    style="font-weight: bold">
                                    <div class="col-md-1 col-lg-2 col-xl-2">
                                        <h6></h6>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                        Nama Produk
                                    </div>
                                    <div class="col-md-1 col-lg-3 col-xl-2 d-flex">
                                        Jumlah
                                    </div>
                                    <div class="col-md-6 col-lg-2 col-xl-3 offset-lg-1">
                                        Harga
                                    </div>
                                </div>
                                <hr class="my-3">
                                @foreach ($detail_pesanan as $data)
                                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                                        <div class="col-md-1 col-lg-2 col-xl-2">
                                            <img src="/product-images/{{ $data->gambar_produk }}"
                                                class="img-fluid rounded-3" alt="Cotton T-shirt">
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <h6 class="text-black mb-0">{{ $data->nama_produk }}</h6>
                                            <small class="text-muted">{{ $data->kategori_produk }}</small>
                                        </div>
                                        <div class="col-md-2 col-lg-3 col-xl-2 d-flex">
                                            <h6>{{ $data->jumlah }}</h6>
                                        </div>
                                        <div class="col-md-5 col-lg-2 col-xl-3 offset-lg-1">
                                            <h6 class="mb-0">Rp. <?php
                                            $angka = $data->jumlah_harga;
                                            echo number_format($angka, 0, ',', '.');
                                            ?></h6>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                @endforeach
                                <div class="pt-4 text-right">
                                    <h4 class="mb-0"><b>Total Harga : </b> Rp. <?php
                                    $angka = $data->total_harga;
                                    echo number_format($angka, 0, ',', '.');
                                    ?></h4>
                                </div>
                            </div>
                        </div>
                        @foreach ($pembayaran as $data)
                            <div class="col-lg-4 bg-secondary rounded-3" style="border-top-right-radius: 15px;border-bottom-right-radius: 15px;color:white">
                                <div class="p-5">
                                    <h4 class="fw-bold mb-2 mt-2 pt-1"><strong>Detail Pesanan</strong></h4>
                                    <hr class="my-4">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="text-uppercase"><b>{{ $jumlah_pesanan->total }} produk</b></h5>
                                        <h5>Rp. <?php
                                        $angka = $data->total_harga;
                                        echo number_format($angka, 0, ',', '.');
                                        ?></h5>
                                    </div>
                                    <hr class="my-3">
                                    <h6 class="text-uppercase mb-3"><b>Tanggal Pemesanan</b></h6>
                                    <div class="mb-2 pb-2">
                                        <h6>
                                            <?php
                                            $tgl = $data->tanggal;
                                            echo date('d F Y', strtotime($tgl));
                                            ?>
                                        </h6>
                                    </div>
                                    <h6 class="text-uppercase mb-3"><b>Nama Pengambil Pesanan</b></h6>
                                    <div class="mb-4 pb-2">
                                        <h6>{{ $data->nama_pengambil }}</h6>
                                    </div>
                                    <h4 class="fw-bold mb-2 mt-5 pt-1">Detail Pembayaran</h4>
                                    <hr class="my-4">

                                    <h6 class="text-uppercase mb-2"><b>Metode Pembayaran</b></h6>
                                    <div class="mb-3 pb-2">
                                        <h6>{{ $data->kapem }}</h6>
                                    </div>
                                    <h6 class="text-uppercase mb-2"><b>Jenis Layanan</b></h6>
                                    <div class="mb-2 pb-2">
                                        <h6>{{ $data->layanan }}</h6>
                                        <h6>{{ $data->no_layanan }}</h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
