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

<div class="container-fluid py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-11">
            @foreach ($pembayaran as $data)
                @if (Route::is('admin.ubahstatus', $data->id))
                    <div class="card card-registration card-registration-2 col-4  d-flex justify-content-center"
                        style="border-radius: 15px;">
                        <form action="/proses/ubah/status/{{ $data->id }}" method="POST">
                            @csrf
                            <div class="card-body p-4">
                                <div class="row mb-3">
                                    <small class="col col-5 mt-1" style="font-weight: bold">Status Pesanan : </small>
                                    <select class="col form-control form-control-sm" name="status" id="status"
                                        style="font-weight: bold">
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
                                <div class="row mb-1 float-center">
                                    <button type="submit" class="col btn btn-warning btn-sm col-sm-12">Ubah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            @endforeach
            @if ($harga->bukti_pembayaran == null)
                <button class="btn btn-success" disabled>Lihat Bukti Pembayaran</button>
                <br>
                <small class=" col-12 bi bi-info-circle text-danger mb-4"> File Bukti Pembayaran Tidak ada</small>
            @else
                <a href="/pembayaran-images/{{ $harga->bukti_pembayaran }}" class="btn btn-success mb-4">Lihat Bukti
                    Pembayaran</a>
            @endif

            <div class="card card-registration card-registration-2 mt-4" style="border-radius: 15px;">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="d-flex justify-content-between align-items-center mb-5">
                                    <h1 class="fw-bold mb-0 text-black">Detail Produk</h1>
                                    <h6 class="mb-0 text-muted">{{ $jumlah_pesanan->total }} Produk</h6>
                                </div>

                                <hr style="height:2px;border-width:0;color:white;background-color:white">
                                <div class="row d-flex justify-content-between align-items-center"
                                    style="font-weight: bold">
                                    <div class="col-md-1 col-lg-2 col-xl-2">
                                        <h6></h6>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3 fw-bold">
                                        Nama Produk
                                    </div>
                                    <div class="col-md-1 col-lg-3 col-xl-2 d-flex fw-bold">
                                        Jumlah
                                    </div>
                                    <div class="col-md-6 col-lg-2 col-xl-3 offset-lg-1 fw-bold">
                                        Harga
                                    </div>
                                </div>
                                <hr style="height:2px;border-width:0;color:white;background-color:white">
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
                                    <hr style="height:2px;border-width:0;color:white;background-color:white">
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
                            <div class="col-lg-5 bg-secondary rounded-3"
                                style="border-top-right-radius: 15px;border-bottom-right-radius: 15px;color:white">
                                <div class="p-5">
                                    <h4 class="fw-bold mb-2 mt-2 pt-1"><strong>Detail Pesanan</strong></h4>

                                    <hr clas="mb-2"
                                        style="height:2px;border-width:0;color:white;background-color:white">
                                    <div class="d-flex justify-content-between mb-2 mt-2">
                                        <h5 class="text-uppercase col-7">ID Pesanan</h5>
                                        <h6 class="col-5">{{ $data->kode }}</h6>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="text-uppercase col-7">Jumlah Produk</h5>
                                        <h6 class="col-5">{{ $jumlah_pesanan->total }} produk</h6>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <h5 class="text-uppercase col-7">Harga Pesanan</h5>
                                        <h6 class="col-5">Rp. <?php
                                        $angka = $data->total_harga;
                                        echo number_format($angka, 0, ',', '.');
                                        ?></h6>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <h5 class="text-uppercase col-7">Tanggal Pesanan</h5>
                                        <h6 class="col-5"><?php
                                        $tgl = $data->tanggal;
                                        echo date('d F Y', strtotime($tgl));
                                        ?></h6>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <h5 class="text-uppercase col-7">Pengambil Pesanan</h5>
                                        <h6 class="col-5">{{ $data->nama_pengambil }}</h6>
                                    </div>
                                    <h4 class="fw-bold mb-2 mt-5 pt-1">Detail Pembayaran</h4>
                                    <hr clas="mb-2"
                                        style="height:2px;border-width:0;color:white;background-color:white">
                                    <div class="d-flex justify-content-between mb-2 mt-2">
                                        <h5 class="text-uppercase col-7">Metode Pembayaran</h5>
                                        <h6 class="col-5">{{ $data->kapem }}</h6>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <h5 class="text-uppercase col-7">Jenis Layanan</h5>
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
