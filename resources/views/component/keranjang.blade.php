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

<!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg table-responsive mb-5">
            <table class="table mb-0">
                <thead class="text-dark text-center">
                    <tr>
                        <th></th>
                        <th>Produk</th>
                        <th>Jumlah Produk</th>
                        <th>Jumlah harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @if (empty($pesanan))
                        <tr class="align-middle">
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>
                                <h4>Keranjang Anda Masih Kosong</h4>
                            </th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    @elseif(!empty($pesanan))
                        @foreach ($pesanan_detail as $item)
                            <tr>
                                <td>
                                    <div class="form-check mx-auto">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="defaultCheck1">
                                    </div>
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
                                <td class="align-middle"><a href="/hapus/pesanan-keranjang/{{$item->id}}"class="btn btn-sm">
                                        <h5 class=" text-danger">Hapus</h5>
                                    </a></td>
                            </tr>
                        @endforeach
                    @endif


                </tbody>
            </table>
        </div>
        <!-- <div class="col-lg-4">
            <form class="mb-5" action="">
                <div class="input-group">
                    <input type="text" class="form-control p-4" placeholder="Coupon Code">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Apply Coupon</button>
                    </div>
                </div>
            </form>
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        <h6 class="font-weight-medium">$150</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">$10</h6>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold">$160</h5>
                    </div>
                    <button class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button>
                </div>
            </div>
        </div> -->
    </div>
</div>
<!-- Cart End -->

<!--Chekout-->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg table-responsive mb-5">
            <table class="table mb-0">
                <thead class="text-dark text-center">
                    <tr>
                        <th class="align-middle">Pilih Semua</th>
                        <th></th>
                        <th></th>
                        <th></th>
<th></th><th></th><th></th>
                        <th class="align-middle">
                            @foreach ($total as $a)
                                <th class="text-right">Total Produk: {{ $a->total }}
                            @endforeach
                        </th>
                        <th></th><th></th>
                        <th class="align-middle">
                            @foreach ($pesanan_harga as $h)
                                Total Harga : Rp. <?php
                                $angka = $h->totalh;
                                echo number_format($angka, 0, ',', '.');
                                ?>
                            @endforeach
                        <th class="align-middle">
                            <a href="/checkout" class="btn btn-secondary px-5">Pesan</a>
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<!--EndCheckout-->
