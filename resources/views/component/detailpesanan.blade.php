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

<div class="container-fluid">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-11">
            <a href="/kelola-pesanan" class="btn btn-secondary mb-4">Kembali</a>
            <br>
            @foreach ($pembayaran as $data)
                @if (Route::is('admin.ubahstatus', $data->id))
                    <div class="card card-registration card-registration-2 col-md-4 d-flex justify-content-center p-3"
                        style="border-radius: 15px;">
                        <form action="/proses/ubah/status/{{ $data->id }}" method="POST">
                            @csrf
                            <div class="card-body mt-4">
                                <div class="row mb-3">
                                    <p class="col fs-5 fw-bolder">Status :</p>
                                    <select class="col form-control form-control-md col-12 mt-2 ml-2" name="status" id="status" style="font-weight: bold">
                                        @foreach ($pembayaran as $data)
                                            <option selected disabled>{{ $data->status }}</option>
                                        @endforeach
                                        <option value="Ditangguhkan">Ditangguhkan</option>
                                        <option value="Dibatalkan">Dibatalkan</option>
                                        <option value="Sedang Diproses">Sedang Diproses</option>
                                        <option value="Siap Diambil">Siap Diambil</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                </div>
                                <div class="row mb-1 float-center float-right mb-4">
                                    <button type="submit" class="col btn btn-warning btn-md">Ubah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            @endforeach
            @if ($harga->bukti_pembayaran == null)
                <button class="btn btn-info" disabled>Lihat Bukti Pembayaran</button>
                <br>
                <small class=" col-12 bi bi-info-circle text-danger mb-4"> File Bukti Pembayaran Tidak ada</small>
            @else
                <a href="/pembayaran-images/{{ $harga->bukti_pembayaran }}" class="btn btn-info mb-4"
                    data-bs-toggle="modal" data-bs-target="#exampleModal">Lihat Bukti Pembayaran</a>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="/pembayaran-images/{{ $harga->bukti_pembayaran }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            @endif

<<<<<<< HEAD
            @if(Auth::user()->role_pengguna != 'Admin')
                <a href="/pesanan" class="btn btn-secondary mb-4">Kembali</a>
            @else
                <a href="/kelola-pesanan" class="btn btn-secondary mb-4">Kembali</a>
            @endif
=======

>>>>>>> origin/master

            @if ($data->status == 'Selesai' && Auth::user()->role_pengguna != 'Admin')
                <div class="card p-3">
                    <h3>Alamat Pengambilan </h3>
                    <small><b>Institute Teknologi Del </b></small>
                    <small>{{ $kontak->no_telp }}</small>
                    <small>Institut Teknologi Del, Sitoluama, Kec. Balige, Toba, Sumatera Utara 22381</small>
                    <a href="http://wa.me/{{ $kontak->no_telp }}" class="btn btn-success w-25 mt-4"> WhatsApp <i
                            class="bi bi-whatsapp"></i></a>
                </div>
            @endif

            <div class="card card-registration card-registration-2 mt-4" style="border-radius: 15px;">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-lg-7">
                            <div class="p-3">
                                <div class="d-flex justify-content-between align-items-center mb-5">
                                    <h1 class="fw-bold mb-0 text-black p-4 fs-3">Detail Produk</h1>
                                    <h6 class="mb-0 text-muted">{{ $jumlah_pesanan->total }} Produk</h6>
                                </div>
                                {{-- <hr style="height:2px;border-width:0;background-color:white"> --}}
                                <div class="row d-flex justify-content-between align-items-center"
                                    style="font-weight: bold">
                                    <div class="col-md-1 col-lg-2 col-xl-3">
                                        <h6></h6>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3 fw-bold">
                                        Produk
                                    </div>
                                    <div class="col-md-1 col-lg-3 col-xl-2 d-flex fw-bold">
                                        Jumlah
                                    </div>
                                    <div class="col-md-6 col-lg-2 col-xl-3 offset-lg-1 fw-bold">
                                        Harga
                                    </div>
                                </div>
                                <hr style="height:2px;border-width:0;background-color:white">
                                @foreach ($detail_pesanan as $data)
                                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                                        <div class="w-25">
                                            <img src="/product-images/{{ $data->gambar_produk }}"
                                                class="img-fluid rounded-3" alt="Cotton T-shirt">
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">

                                            <p class="fw-medium fst-italic">{{ $data->nama_produk }}</p>
                                            @if ($data->ukurans != null)
                                                <p class="fw-semibold">Size: <p class="fw-medium fst-italic">{{ $data->ukurans }}</p> </p>
                                            @else
                                                <p class="fw-semibold">Size: -</p>
                                            @endif
                                            @if ($data->warna_produk != null)
                                                <p class="fw-semibold">Warna: <p class="fw-medium fst-italic">{{ $data->warna_produk }}</p></p>
                                            @else
                                                <p class="fw-semibold">Warna: -</p>
                                            @endif
                                            @if ($data->angkatans != null)
                                                <p class="fw-semibold">Angkatan: <p class="fw-medium fst-italic">{{ $data->angkatans }}</p></p>
                                            @else
                                                <p class="fw-semibold">Angkatan: -</p>
                                            @endif
                                        </div>
                                        <div class="col-md-2 col-lg-3 col-xl-2 d-flex">
                                            <h6 class="ml-3">{{ $data->jumlah }}</h6>
                                        </div>
                                        <div class="col-md-5 col-lg-2 col-xl-3 offset-lg-1">
                                            <h6 class="mb-0">Rp. <?php
                                            $angka = $data->jumlah_harga;
                                            echo number_format($angka, 0, ',', '.');
                                            ?></h6>
                                        </div>
                                    </div>
                                    <hr style="height:2px;border-width:0;background-color:white">
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
                            <div class="col-lg-5 bg-secondary rounded-3 text-light">
                                <div class="p-2 my-5 mx-4">
                                    <h4 class="fw-bold mb-2 mt-2 pt-1 fs-3"><strong>Detail Pesanan</strong></h4>
                                    <hr clas="mb-2"
                                        style="height:2px;border-width:0;background-color:white">
                                    <div class="d-flex mb-2 mt-2">
                                        <p class="text-capitalize col-7">ID Pesanan</p>
                                        <p class="fs-6 fw-bold">{{ $data->kode }}</p>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <p class="text-capitalize col-7">Jumlah Produk</p>
                                        <h6 class="col-5">{{ $jumlah_pesanan->total }} produk</h6>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="text-capitalize col-7">Harga Pesanan</p>
                                        <h6 class="col-5">Rp. <?php
                                        $angka = $data->total_harga;
                                        echo number_format($angka, 0, ',', '.');
                                        ?></h6>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="text-capitalize col-7">Tanggal Pesanan</p>
                                        <h6 class="col-5"><?php
                                        $tgl = $data->tanggal;
                                        echo date('d F Y', strtotime($tgl));
                                        ?></h6>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="text-capitalize col-7">Pengambil Pesanan</p>
                                        <h6 class="col-5">{{ $data->nama_pengambil }}</h6>
                                    </div>
                                    <h4 class="fw-bold mb-2 mt-5 fs-4">Detail Pembayaran</h4>
                                    <hr clas="mb-2"
                                        style="height:2px;border-width:0;background-color:white">
                                    <div class="d-flex justify-content-between mb-2 mt-2">
                                        <p class="text-capitalize col-7 fs-6">Metode Pembayaran</p>
                                        <h6 class="col-5 fw-bolder">{{ $data->kapem }}</h6>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="text-capitalize col-7 fs-6">Jenis Layanan</p>
                                        <h6 class="col-5">{{ $data->layanan }}</h6>
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
