<!-- Navbar Start -->
<div class="container-fluid">
    <div class="row px-xl-5 mt-5">
        <div class="col">
            <b>
                <h2>Pesanan</h2>
            </b>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container-fluid">
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
        <div class="container-fluid">
            <div class="row mt-3 px-xl-5">
                <div class="col">
                    <p>Silahkan Ambil Pesanan Anda di:</p>
                    <p>
                        <b>Institut Teknologi Del,</b>
                    </p>
                    <p>
                        Depan gerbang Institut Teknologi Del, Sitoluama, KAB. TOBA SAMOSIR - Sigumpar, Sumatera Utara,
                        ID
                        22353
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
<!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg table-responsive mb-3">
            <form action="">
                <table class="table mb-0">
                    <thead class="text-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
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
                                    {{$no++}}
                                </td>
                                <td class="align-middle">
                                    <img src="/product-images/{{ $item->gambar_produk }}" alt=""
                                        style="width: 120px;height:130px">
                                    <h5 class="mt-3">{{ $item->nama_produk }}</h5>
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
                                <td class="align-middle">Rp. <?php
                                $angka = $item->jumlah_harga;
                                echo number_format($angka, 0, ',', '.');
                                ?></h5>
                                </td>
                                <!-- <td class="align-middle"><button class="btn btn-sm"><i class="fa fa-times"></i></button></td> -->
                                <td class="align-middle"><a
                                        href="/hapus/pesanan-keranjang/{{ $item->id }}"class="btn btn-sm">
                                        <h5 class=" text-danger">Hapus</h5>
                                    </a></td>
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
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg table-responsive mb-3">
            <table class="table mb-0">
                <thead class="text-dark text-center">
                    <tr>
                        <!-- <th>Pilih Semua</th> -->
                        <th></th>
                        <th class="text-right">
                            <span class="h5">Total (2 Produk): </span>
                            <span class="h3"><b>Rp. 450.000</b></span>
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

<!--Chekout-->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg table-responsive mb-5 px-xl-5">
            <div class="text-left">
                <h3>
                    Metode Pembayaran:
                    {{-- <a href="" class="btn border text-secondary btn-lg">Bayar Ditempat</a>
                    <a href="" class="btn border text-dark btn-lg">Transfer Bank</a> --}}
                </h3>
            </div>
        </div>
    </div>
</div>
<!--EndCheckout-->
