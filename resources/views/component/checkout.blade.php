<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
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
        <form action="/proses-checkout" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row px-xl-5">
                <div class="col-lg table-responsive mb-5">
                    <div class="text-left">
                        <small>Silahkan melakukan pembayaran sesuai dengan data yang tersedia!</small>
                        <h6 class="mt-4">
                            <b>Pilih Metode Pembayaran</b>
                            {{-- <a href="" class="btn border text-secondary btn-lg">Bayar Ditempat</a>
                        <a href="" class="btn border text-dark btn-lg">Transfer Bank</a> --}}
                        </h6>
                        <h6>
                            <select name="kategori_pembayaran" id="kategori_pembayaran" class="form-control">
                                <option value="0" selected><b>Silahkan Pilih Metode Pembayaran</b></option>
                                @foreach ($kapem as $data)
                                    <option value="{{ $data->id }}">{{ $data->kategori_pembayaran }}
                                    </option>
                                @endforeach
                            </select>
                        </h6>

                        <div class="mb-3 mt-4" name="f-metpem" id="f-metpem" hidden>
                            <h6 class="mt-3">
                                <b>Pilih Layanan</b>
                            </h6>
                            <h6><select name="metode_pembayaran" id="metode_pembayaran" class="form-control"></select>
                            </h6>
                        </div>
                        <div class="col mt-4" name="layanan" id="layanan" hidden>
                            <div class="row mt-4">
                                <h6><b>Metode Pembayaran</b></h6>
                            </div>
                            <div class="row">
                                <p class="col-4"><b>Nama Layanan </b></p>
                                <p class="col-1">:</p>
                                <p name="namaLayanan" id="namaLayanan"></p>
                            </div>
                            <div class="row">
                                <p class="col-4"><b>Nomor Pembayaran </b></p>
                                <p class="col-1">:</p>
                                <p name="nomorLayanan" id="nomorLayanan"></p>
                            </div>
                        </div>
                        <div class="mb-4" name="error" id="error" hidden>Silahkan Pilih Metode Pembayaran
                            Terlebih Dahulu Untuk Melanjutkan Proses Tranksaksi</div>

                        <h6 class="mt-4" id="form-bukti-pembayaran" name="form-bukti-pembayaran" hidden>
                            <b>Upload Bukti Pembayaran</b>
                            @foreach ($pesanan_harga as $h)
                                <p class="mt-1 ml-2"><small>Total Harga Pesanan : <b>Rp.
                                            <?php
                                            $angka = $h->totalh;
                                            echo number_format($angka, 0, ',', '.');
                                            ?></b></small></p>
                            @endforeach
                            <input class="form-control col-lg-12 mt-1" type="file" name="bukti_pembayaran"
                                id="bukti_pembayaran" required>
                        </h6>
                        <h6 class="mt-4" id="input-pengambil-pesanan" name="input-pengambil-pesanan" hidden>
                            <b>Nama Pengambil Pesanan</b>
                            <input class="form-control col-lg-12 mt-3" type="text" name="nama_pengambil"
                                id="nama_pengambil" required>
                        </h6>

                        <div class="row col-12 mt-4 mb-5 " name="btn-pembayaran" id="btn-pembayaran" hidden>
                            <button type="submit" class="btn btn-success text-white py-2 ml-2 col-4 float-right">
                                Kirim
                            </button>

                            <p class="row mt-5 col-12">
                                <small><i class="bi bi-info-circle"></i></small>
                                    <small class="ml-1">Silahkan Ambil Pesanan Anda di : <b> Institut Teknologi
                                        Del,</b><br>

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
        $('#metode-pembayaran').select();
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#kategori_pembayaran').on('change', function() {
            var kapemId = this.value;
            $('#metode_pembayaran').html('');
            $.ajax({
                url: '{{ route('getMetpem') }}?kapem_id=' + kapemId,
                type: 'get',
                success: function(res) {
                    if (kapemId == "0") {
                        $('#error').prop('hidden', false);
                        $('#f-metpem').prop('hidden', true);
                        $('#layanan').prop('hidden', true);
                    }
                    if (kapemId != "0") {
                        $('#metode_pembayaran').html(
                            '<option value="0">Pilih Layanan Pembayaran</option>');
                        $.each(res, function(key, value) {
                            $('#metode_pembayaran').append('<option value="' + value
                                .id + '">' + value.nama_layanan + '</option>');
                        });
                        $('#f-metpem').prop('hidden', false);
                    }

                }
            });
        });
        $('#metode_pembayaran').on('change', function() {
            var metpemId = this.value;
            $('#namaLayanan').html('');
            $.ajax({
                url: '{{ route('getLayanan') }}?metpem_id=' + metpemId,
                type: 'get',
                success: function(res) {
                    if (metpemId == "0") {
                        $('#error').prop('hidden', false);
                        $('#layanan').prop('hidden', true);
                        $('#form-bukti-pembayaran').prop('hidden', true);
                        $('#input-pengambil-pesanan').prop('hidden', true);
                        $('#btn-pembayaran').prop('hidden', true);
                    }
                    if (metpemId != "0") {
                        $.each(res, function(key, value) {
                            document.getElementById('namaLayanan').innerHTML = value
                                .nama_layanan;
                            document.getElementById('nomorLayanan').innerHTML =
                                value.no_layanan
                        });
                        $('#layanan').prop('hidden', false);
                        $('#form-bukti-pembayaran').prop('hidden', false);
                        $('#input-pengambil-pesanan').prop('hidden', false);
                        $('#btn-pembayaran').prop('hidden', false);
                    }
                }
            });
        });
    });
</script>

<!--EndCheckout-->
