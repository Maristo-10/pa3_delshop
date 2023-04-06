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
<div class="row shadow-sm rounded mt-3 bg-white p-3" style="justify-content:center;align-items:center;display:flex;">
    <div class="col-10 mt-3 ml-2 mb-5 text-center">
        <h2>Detail Pesanan</h2>
    </div>
    <div class="row col-10 mt-3 ml-3 mb-5" style="border:solid 1px">
        <div class="col-md-6 mb-5">
            <div class="row mt-5">
                <div class="col-12 text-center mb-3">
                    <b>
                        <h4> Detail Produk</h4>
                    </b>
                </div>
                @foreach ($detail_pesanan as $data)
                    <div class="row col-12 mb-5">
                        <div class="">{{ $no++ }}.</div>
                        <div class="col-md-4">
                            <img class="col-12" src="/product-images/{{ $data->gambar_produk }}" alt=""
                                style="border: solid 3px;height:130px">
                        </div>
                        <div class="col col-7">
                            <table style="height: 100px">
                                <tr>
                                    <td>Nama Produk</td>
                                    <td class="col-1">:</td>
                                    <td class="col-11">{{ $data->nama_produk }}</td>
                                </tr>
                                <tr>
                                    <td>Harga/Satuan</td>
                                    <td class="col-1">:</td>
                                    <td class="col-11">Rp. <?php
                                    $angka = $data->harga;
                                    echo number_format($angka, 0, ',', '.');
                                    ?></td>
                                </tr>
                                <tr>
                                    <td>Jumlah Produk</td>
                                    <td class="col-1">:</td>
                                    <td class="col-11">{{ $data->jumlah }}</td>
                                </tr>
                                <tr>
                                    <td>Harga Total</td>
                                    <td class="col-1">:</td>
                                    <td class="col-11"><b>Rp. <?php
                                    $angka = $data->jumlah_harga;
                                    echo number_format($angka, 0, ',', '.');
                                    ?></b> </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endforeach
                <div class="col-9 text-right mb-3">
                    <h5><b>Total Pembayaran : Rp. <?php
                    $angka = $harga->jumlah_harga;
                    echo number_format($angka, 0, ',', '.');
                    ?></b></h5>
                </div>
            </div>
        </div>

        <!--Chekout-->
        <div class="col-md-6 mb-5">
            <div class="row mt-5 mb-4">
                <div class="col-12 text-center mb-3">
                    <b>
                        <h4>Pembayaran</h4>
                    </b>
                </div>
                @foreach ($pembayaran as $data)
                    <div class="row col-12">
                        <div class="row col-9">
                            <div class="col-12" style="height: 220px">
                                <table class="mt-0" style="height: 80px">
                                    <tr>
                                        <td><b>
                                                <h6>Metode Pembayaran</h6>
                                            </b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Metode Pembayaran</td>
                                        <td>:</td>
                                        <td>{{ $data->kapem }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Layanan</td>
                                        <td>:</td>
                                        <td>{{ $data->nama_layanan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Pembayaran</td>
                                        <td>:</td>
                                        <td>{{ $data->no_layanan }}</td>
                                    </tr>
                                </table>
                                <table class="mt-3">
                                    <tr>
                                        <td><b>
                                                <h6>Pengambil Pesanan</h6>
                                            </b></td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td>{{ $data->nama_pengambil }}</td>
                                    </tr>
                                </table>
                                <p class="row mt-4 col-12">
                                    <small><i class="bi bi-info-circle"></i></small>
                                    <small class="">Silahkan Ambil Pesanan Anda di : <b> Institut Teknologi
                                            Del,</b><br>

                                        Depan gerbang Institut Teknologi Del, <br> Sitoluama, KAB. TOBA SAMOSIR -
                                        Sigumpar,
                                        Sumatera Utara,
                                        ID
                                        22353
                                    </small>
                                </p>
                            </div>
                        </div>
                        <div class="row col-3">
                            <b>
                                <h6>Bukti Pembayaran</h6>
                            </b>
                            <div class="">
                                @empty($data->bukti_pembayaran)
                                    <h5 class="text-center col-12 ml-2">Kosong</h5>
                                @else
                                    <img src="/pembayaran-images/{{ $data->bukti_pembayaran }}" alt=""
                                        style="height:140px">
                                @endempty

                            </div>
                        </div>


                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


<!--EndCheckout-->
