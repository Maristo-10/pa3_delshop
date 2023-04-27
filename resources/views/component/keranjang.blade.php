<!-- Page Header Start -->
<div class="container-fluid ">
    <div class="row px-xl-5 mt-3">
        <div class="col-lg">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header End -->

<section class="h-100">
    <div class="container h-100 py-5 col-9">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4 text-center">
                    <h2 class="fw-normal mb-0 text-black"><strong>Keranjang Belanja</strong></h2>
                </div>
                @if (isset($pesanan))
                    @foreach ($pesanan_detail as $item)
                        <div class="card rounded-3 mb-4">
                            <div class="card-body p-3">
                                <div class="row d-flex justify-content-between align-items-center">
                                    <div class="col-md-2 col-lg-2 col-xl-1">
                                        <img src="/product-images/{{ $item->gambar_produk }}"
                                            class="img-fluid rounded-3" alt="Cotton T-shirt">
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                        <p class="lead fw-normal mb-2">{{ $item->nama_produk }}</p>
                                        <p><span class="text-muted">Size: </span>M <span class="text-muted">
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                        <button class="btn btn-link px-2"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <input id="form1" min="0" name="quantity" value="{{ $item->jumlah }}"
                                            type="number" class="form-control form-control-sm" />

                                        <button class="btn btn-link px-2"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                        <h5 class="mb-0">Rp. <?php
                                            $angka = $item->jumlah_harga;
                                            echo number_format($angka, 0, ',', '.');
                                            ?></h5>
                                    </div>
                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                        <a href="/hapus/pesanan-keranjang/{{ $item->id }}" class="text-danger"><i
                                                class="fas fa-trash fa-lg"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="card mt-5">
                        <div class="card-body">
                            <a href="/checkout" class="btn btn-success btn-block btn-lg">Lanjutkan Pesanan</a>
                        </div>
                    </div>
                @else
                    <div class="card rounded-3 mb-4">
                        <div class="card-body p-3">
                            <div class="row d-flex justify-content-between align-items-center">
                                <h1>Keranjang Anda Kosong</h1>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</section>
<!--EndCheckout-->
