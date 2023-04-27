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
<!--Chekout-->
<div class="container py-5 h-100 col-11">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
            <div class="card">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-7">
                            <h5 class="mb-3"><a href="/keranjang" class="text-body"><i
                                        class="fas fa-long-arrow-alt-left me-2"></i> Kembali</a></h5>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <h5>Detail Produk</h5>
                                </div>
                            </div>
                            <div class="mb-3">
                                @foreach ($pesanan as $a)
                                <p class="mb-0">Anda mempunyai <b>{{ $a->total }}</b> Barang di Keranjang</p>
                                {{-- <span class="h6">Total ( {{ $a->total }} Produk): </span> --}}
                            @endforeach

                            </div>
                            @foreach ($pesanan_detail as $item)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-row align-items-center">
                                            <div>
                                                <img src="/product-images/{{ $item->gambar_produk }}"
                                                    class="img-fluid rounded-3" alt="Shopping item"
                                                    style="width: 65px;">
                                            </div>
                                            <div class="ms-3 ml-3">
                                                <h5>{{ $item->nama_produk }}</h5>
                                                <p class="small mb-0">{{ $item->kategori_produk }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center text-left">
                                            <div style="width: 10px;" class="mr-5">
                                                <h5 class="fw-normal mb-0">{{ $item->jumlah }}</h5>
                                            </div>
                                            <div style="width: 130px;">
                                                <h6 class="mb-0">Rp. <?php
                                                    $angka = $item->jumlah_harga;
                                                    echo number_format($angka, 0, ',', '.');
                                                    ?></h6>
                                            </div>
                                            <a href="#!" style="color: #cecece;"><i
                                                    class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @foreach ($pesanan_harga as $h)
                            <div class="pt-4 text-right">
                                <h4 class="mb-0"><b>Total Harga : </b>Rp. <?php
                                    $angka = $h->totalh;
                                    echo number_format($angka, 0, ',', '.');
                                    ?></h4>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-lg-5">
                            <div class="card bg-secondary text-white rounded-3">
                                <div class="card-body p-5">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h3 class="mb-0"><strong>Pembayaran</strong></h3>
                                    </div>
                                    <div class="mb-3">
                                        <p class="mb-0">Silahkan Pilih Metode Pembayaran!</p>
                                    </div>
                                    <form class="mt-4" action="/proses-checkout" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label " for="kategori_pembayaran">Metode
                                                Pembayaran</label>
                                            <select name="kategori_pembayaran" id="kategori_pembayaran"
                                                class="form-control form-control-md" sizez="17" style="border-radius: 5px">
                                                <option value="0" selected><small>Pilih Metode
                                                        Pembayaran</small></option>
                                                @foreach ($kapem as $data)
                                                    <option value="{{ $data->id_kapem }}">
                                                        {{ $data->kategori_pembayaran }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-outline form-white mb-4" name="f-metpem" id="f-metpem" hidden>
                                            <label class="form-label" for="metode_pembayaran">Pilih Layanan</label>
                                            <select name="metode_pembayaran" id="metode_pembayaran"
                                                class="form-control form-control-md" style="border-radius: 5px">
                                            </select>
                                        </div>

                                        <div class="form-outline form-white mb-3 pb-2" name="layanan" id="layanan" hidden>
                                            <strong>Detail Layanan Pembayaran</strong>
                                            <table>
                                                <tr>
                                                    <td>Nama Layanan</td>
                                                    <td class="col-2">:</td>
                                                    <td name="namaLayanan" id="namaLayanan"></td>
                                                </tr>
                                                <tr>
                                                    <td>Nomor Pembayaran</td>
                                                    <td class="col-2">:</td>
                                                    <td name="nomorLayanan" id="nomorLayanan"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="mb-4" name="error" id="error" hidden>Silahkan Pilih Metode Pembayaran
                                            Terlebih Dahulu Untuk Melanjutkan Proses Tranksaksi</div>

                                        <div class="form-outline form-white mb-3 pb-2" name="form-bukti-pembayaran" id="form-bukti-pembayaran" hidden>
                                            <strong>Upload Bukti Pembayaran</strong><br>
                                            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="mt-2">
                                        </div>

                                        <p id="input-pengambil-pesanan" name="input-pengambil-pesanan" hidden>
                                            <b>Nama Pengambil Pesanan</b>
                                            <input class="form-control form-control-md mt-2" type="text" name="nama_pengambil"
                                                id="nama_pengambil" style="border-radius: 5px" required>
                                        </p>
                                        <button type="submit" class="btn btn-block btn-lg mt-5" name="btn-pembayaran" id="btn-pembayaran" style="background-color: #212A3E;">
                                            <div class="d-flex justify-content-between" style="color:white">
                                                @foreach ($pesanan_harga as $h)
                                                <span>Rp. <?php
                                                    $angka = $h->totalh;
                                                    echo number_format($angka, 0, ',', '.');
                                                    ?></span>
                                                @endforeach
                                                <span>Pesan <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                .id_metpem + '">' + value.nama_layanan +
                                '</option>');
                        });
                        $('#f-metpem').prop('hidden', false);
                        $('#error').prop('hidden', true);
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
                        $('#error').prop('hidden', true);
                    }
                }
            });
        });
    });
</script>

<!--EndCheckout-->
