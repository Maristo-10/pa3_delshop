<!-- Page Header Start -->
<div class="container-fluid ">
    <div class="row px-xl-5 mt-3">
        <div class="col-lg">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/keranjang">Keranjang</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header End -->
<!-- Navbar Start -->
<div class="row col-lg-12 mt-5">
    <div class="col-lg-6 ml-5" style="border: solid 1px">
        <div class="row px-xl-12 mt-5">
            <div class="col text-center">
                <b>
                    <h2> Detail Pesanan</h2>
                </b>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="row px-xl-5 mt-4">
                <table>
                    @foreach ($pengguna_prof as $pembeli)
                        <thead>
                            <tr>
                                <th><b class="h5">Pemesanan A.N </b></th>
                                <th class="px-xl-4">{{ $pembeli->name }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><b class="h5">No. Telepon</b></th>
                                <th class="px-xl-4">{{ $pembeli->no_telp }}</th>
                            </tr>
                        </tbody>
                    @endforeach

                </table>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="col text-center mt-4">
                <b>
                    <h5> Detail Produk Pesanan</h5>
                </b>
            </div>
        </div>


        <!-- Cart Start -->
        <div class="pt-2 col-lg-12">
            <div class="row px-xl-5">
                <div class="col-lg table-responsive mb-3">
                    <form action="">
                        <table class="table mb-0">
                            <thead class="text-dark text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga/Satuan</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($pesanan_detail as $item)
                                    <tr>
                                        <td>
                                            {{ $no++ }}
                                        </td>
                                        <td class="align-middle">
                                            <img src="/product-images/{{ $item->gambar_produk }}" alt=""
                                                style="width: 100px;height:110px">
                                            <h6 class="mt-3">{{ $item->nama_produk }}</h6>
                                        </td>
                                        <td class="align-middle">
                                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-minus">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="text" class="form-control form-control- text-center"
                                                    value="{{ $item->jumlah }}">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-plus">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <h6>Rp. <?php
                                            $angka = $item->harga;
                                            echo number_format($angka, 0, ',', '.');
                                            ?></h6>
                                        </td>
                                        <!-- <td class="align-middle"><button class="btn btn-sm"><i class="fa fa-times"></i></button></td> -->
                                        <td class="align-middle">
                                            <h6>Rp. <?php
                                            $angka = $item->jumlah_harga;
                                            echo number_format($angka, 0, ',', '.');
                                            ?></h6>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <!-- Cart End -->

        <!--Chekout-->
        <div class="pt-2 col-lg-12 ml-5">
            <div class="row px-xl-5">
                <div class="col-lg table-responsive mb-3">
                    <table class="table mb-0">
                        <thead class="text-dark text-center">
                            <tr>
                                <!-- <th>Pilih Semua</th> -->
                                <th></th>
                                <th class="align-middle">
                                </th>
                                <th class="text-right">
                                    @foreach ($pesanan as $a)
                                        <span class="h6">Total ( {{ $a->total }} Produk): </span>
                                    @endforeach
                                    @foreach ($pesanan_harga as $h)
                                        <span class="h5"><b>Rp. <?php
                                        $angka = $h->totalh;
                                        echo number_format($angka, 0, ',', '.');
                                        ?></b></span>
                                    @endforeach
                                </th>
                                <!-- <th>
                                <a href="btn btn-secondary px-5">Pesan</a>
                            </th> -->
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!--EndCheckout-->
    </div>
    <!--Chekout-->

    <div class="col-lg-5 pt-5 ml-5" style="border: solid 1px">
        <div class="row px-xl-12 mb-4">
            <div class="col text-center">
                <b>
                    <h2>Pembayaran</h2>
                </b>
            </div>
        </div>
        <form action="">

            <div class="row px-xl-5">
                <div class="col-lg table-responsive mb-5">
                    <div class="text-left">
                        <small>Silahkan melakukan pembayaran sesuai dengan data yang tersedia!</small>
                        <h6 class="mt-3">
                            <b>Pilih Metode Pembayaran</b>
                            {{-- <a href="" class="btn border text-secondary btn-lg">Bayar Ditempat</a>
                        <a href="" class="btn border text-dark btn-lg">Transfer Bank</a> --}}
                        </h6>
                        <h6>
                            <select name="metode-pembayaran" id="metode-pembayaran" class="form-control col-lg-12"
                                onchange="getValue(this);">
                                <option selected><b>Silahkan Pilih Metode Pembayaran</b></option>
                                <option value="Transfer Bank">Transfer Bank</option>
                                <option value="E-Wallet">E-Wallet</option>
                                <option value="Bayar Langsung">Bayar Langsung</option>
                            </select>
                        </h6>

                        <h6 name="select-jenis-bank" id="select-jenis-bank" hidden>
                            <select name="jenis-bank" id="jenis-bank" class="form-control col-lg-12"
                                onchange="getValueBank(this);">
                                <option selected><b>Silahkan Pilih Jenis Bank</b></option>
                                <option value="BRI">BRI</option>
                                <option value="Mandiri">Mandiri</option>
                                <option value="BNI">BNI</option>
                            </select>
                        </h6>
                        <input name="BRI" id="BRI" class="form-control col-lg-12" type="text"
                            value="No Bank BRI : 1234567890" disabled hidden>
                        <input name="Mandiri" id="Mandiri" class="form-control col-lg-12" type="text"
                            value="No Bank Mandiri : 1234567890" disabled hidden>
                        <input name="BNI" id="BNI" class="form-control col-lg-12" type="text"
                            value="No Bank BNI : 1234567890" disabled hidden>

                        <h6 class="mt-3" id="form-bukti-pembayaran" name="form-bukti-pembayaran" hidden>
                            <b>Upload Bukti Pembayaran</b>
                            @foreach ($pesanan_harga as $h)
                                <p class="mt-1 ml-2"><small>Total Harga Pesanan : <b>Rp.
                                            <?php
                                            $angka = $h->totalh;
                                            echo number_format($angka, 0, ',', '.');
                                            ?></b></small></p>
                            @endforeach
                            <input class="form-control col-lg-12 mt-1" type="file" name="bukti_pembayaran"
                                id="bukti_pembayaran">
                        </h6>

                        <h6 class="mt-3" id="input-pengambil-pesanan" name="input-pengambil-pesanan" hidden>
                            <b>Nama Pengambil Pesanan</b>
                            <input class="form-control col-lg-12 mt-3" type="text" name="nama_pengambil"
                                id="nama_pengambil">
                        </h6>

                        <div class="row col-12 mt-4 mb-5 " name="btn-pembayaran" id="btn-pembayaran" hidden>
                            <button type="submit" class="btn btn-success text-white py-2 ml-2 col-4 float-right">
                                Kirim
                            </button>
                            <p class="mt-3 col-12"><small> Silahkan Ambil Pesanan Anda di : <b> Institut Teknologi Del,</b><br></small>
                                <small>
                                    Depan gerbang Institut Teknologi Del, <br> Sitoluama, KAB. TOBA SAMOSIR - Sigumpar,
                                    Sumatera Utara,
                                    ID
                                    22353
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#metode-pembayaran').select2();
    });

    function getValue(option) {
        $select = option.value;
        if ($select == "Transfer Bank") {
            $('#select-jenis-bank').prop('hidden', false);
        } else if ($select == "E-Wallet") {
            $('#form-pembayaran').prop('hidden', true);
        } else if ($select == "Bayar Langsung") {
            $('#form-pembayaran').prop('hidden', true);
        }
    }
</script>
<!--EndCheckout-->
