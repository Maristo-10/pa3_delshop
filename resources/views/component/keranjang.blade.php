
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
    <div class="container h-100 py-5 col-11">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4 text-center">
                    <h2 class="fw-normal mb-0 text-black"><strong>Keranjang Belanja</strong></h2>
                </div>

                @if (isset($pesanan))
                    @foreach ($pesanan_detail as $item)
                        @if ($item->pesanan_id == $pesanan_c->id)
                            <div class="card rounded-3 mb-4" style="background-color:gainsboro">
                            @else
                                <div class="card rounded-3 mb-4">
                        @endif

                        <div class="card-body p-3">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-md-3 col-lg-3 col-xl-2">
                                    <img src="/product-images/{{ $item->gambar_produk }}" class="img-fluid rounded-3"
                                        alt="">
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-2">
                                    <p class="lead fw-normal mb-2">{{ $item->nama_produk }}</p>
                                    @if ($item->ukurans != null)
                                        <p><span class="">Size: </span>{{ $item->ukurans }}<span class="">
                                            @else
                                                <p><span class="">Size: </span> - <span class="">
                                    @endif
                                    @if ($item->warna_produk != null)
                                        <p><span class="">Warna: </span>{{ $item->warna_produk }}<span
                                                class="">
                                            @else
                                                <p><span class="">Warna: </span> - <span class="">
                                    @endif
                                    @if ($item->angkatans != null)
                                        <p><span class="">Angkatan: </span>{{ $item->angkatans }}<span
                                                class="">
                                            @else
                                                <p><span class="">Angkatan: </span> - <span class="">
                                    @endif
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                    <button class="btn btn-link px-2"
                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input id="form1" min="0" name="jumlah" id="jumlah"
                                        value="{{ $item->jumlah }}" type="number"
                                        class="form-control form-control-sm" />

                                    <button class="btn btn-link px-2"
                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div class="col-md-2 col-lg-2 col-xl-2 offset-lg-1">
                                    <h5 class="mb-0">Rp. <?php
                                    $angka = $item->jumlah_harga;
                                    echo number_format($angka, 0, ',', '.');
                                    ?></h5>
                                </div>
                                <div class="row col-md-1 col-lg-3 col-xl-1 mr-4 text-end">
                                    @if ($item->pesanan_id == $pesanan_c->id)
                                      <form action="/remove-checkout/{{ $item->id }}" method="post" class="d-flex justify-content-between">
                                        @csrf
                                        <div>
                                          <i class="col col-2 text-success fs-3 bi bi-bag-check-fill" aria-disabled="true" title="Data Sudah Dipilih"></i>
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" name="remove-{{ $item->id }}"
                                                id="remove-{{ $item->id }}" method="post" hidden></button>
                                            <label for="remove-{{ $item->id }}"
                                                title="Hapus Produk dari Checkout"><i
                                                    class="fas fa-trash fa-lg text-danger mr-4"></i></label>
                                        </div>
                                      </form>
                                    @else
                                      <form action="/add-checkout/{{ $item->id }}" method="post" class="d-flex justify-content-between">
                                        @csrf
                                        <input type="hidden" id="tambahId" value="{{ $item->id }}">
                                        <button type="submit" class="text-success fs-3" name="btnId-{{ $item->id }}" id="btnId-{{ $item->id }}" hidden></button>
                                        <div class="mr-1">
                                          <label for="btnId-{{ $item->id }}" title="Pilih Produk untuk Checkout" ><i class="text-success fs-3 bi bi-bag-plus-fill"></i></label>
                                        </div>
                                        <div class="mt-2 ml-1">
                                          <a href="/hapus/pesanan-keranjang/{{ $item->id }}" class="text-danger ml-2 mr-2" title="Hapus Produk dari Keranjang"><i class="fas fa-trash fa-lg"></i></a>
                                        </div>
                                      </form>
                                    @endif
                                  </div>
                            </div>
                        </div>
            </div>
        </div>
        </form>
        @endforeach

        @endif

        @if ($lama == 0)
            <div class="card rounded-3 mb-4">
                <div class="card-body p-3">
                    <div class="row d-flex justify-content-between align-items-center">
                        <h3 class="text-muted">Keranjang Anda Kosong</h3>
                    </div>
                </div>
            </div>
        @endif

        <div class="card mt-5">
            <div class="card-body">
                @if ($detail == 0)
                    <button class="btn btn-success btn-block btn-lg" disabled>Lanjutkan Proses
                        Checkout</button>
                    <small class="bi bi-info-circle text-danger"> Silahkan Pilih Produk Terlebih Dahulu
                        untuk Di Checkout!</small>
                @else
                    <a href="/checkout" class="btn btn-success btn-block btn-lg">Lanjutkan Proses
                        Checkout</a>
                @endif
            </div>
        </div>

    </div>
    </div>
    </div>
</section>

<!--EndCheckout-->
