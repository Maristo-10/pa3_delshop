<!-- Page Header Start -->
<div class="container-fluid ">
    <div class="row px-xl-5 mt-3">
        <div class="col-lg">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/list-produk">Produk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail-Product</li>

                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Shop Detail Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5 mb-5">
        <div class="col-lg-5 pb-5">
            @foreach ($produk as $item)
                <div class="carousel-item active">
                    <img class="w-100 h-100" src="/product-images/{{ $item->gambar_produk }}" alt="Image"
                        style="max-width:400px;max-height:500px;min-width:250px;min-height:320px">
                </div>

        </div>

        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <h1 class="h2">{{ $item->nama_produk }}</h1>
                    <p class="h3 py-2">Rp.
                        <?php
                        $angka = $item->harga;
                        echo number_format($angka, 0, ',', '.');
                        ?>
                    </p>
                    <h6 class="mt-3">Deskripsi:</h6>
                    <p>{{ $item->deskripsi }}</p>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <h6>Warna yang tersedia :</h6>
                        </li>
                        <li class="list-inline-item">
                            <p class="text-muted"><strong>White / Black</strong></p>
                        </li>
                    </ul>
                    {{-- <h6>Spesifikasi:</h6>
                    <ul class="list-unstyled pb-3">
                        <li>Lorem ipsum dolor sit</li>
                        <li>Amet, consectetur</li>
                        <li>Adipiscing elit,set</li>
                        <li>Duis aute irure</li>
                        <li>Ut enim ad minim</li>
                        <li>Dolore magna aliqua</li>
                        <li>Excepteur sint</li>
                    </ul> --}}
                    <form action="/produk/tambah-keranjang/{{ $item->id_produk }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $item->id_produk }}">
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-inline pb-3">
                                    <li class="list-inline-item">Size :
                                        <input type="hidden" name="product-size" id="product-size" value="S">
                                    </li>
                                    <li class="list-inline-item"><span class="btn btn-primary btn-size">S</span></li>
                                    <li class="list-inline-item"><span class="btn btn-primary btn-size">M</span></li>
                                    <li class="list-inline-item"><span class="btn btn-primary btn-size">L</span></li>
                                    <li class="list-inline-item"><span class="btn btn-primary btn-size">XL</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group quantity">
                                    <div class="minus changeQuantity" style="cursor: pointer">
                                        <button type="button" class="input-group-text">-</button>
                                    </div>
                                    <input type="number" name="jumlah" id="jumlah" class="qty-input form-control"
                                        value="1">
                                    <div class="plus changeQuantity" style="cursor: pointer">
                                        <button type="button" class="input-group-text">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pb-3">
                            <div class="col-md-4 offset-md-8">
                                @if ($item->role_pembeli == 'Publik')
                                    <button type="submit" class="btn btn-primary btn-lg text-center" name="submit"
                                        value="addtocard">Add To Cart</button>
                                @else
                                    @if ($item->role_pembeli == Auth::user()->role_pengguna)
                                        <button type="submit" class="btn btn-primary btn-lg text-center" name="submit"
                                            value="addtocard">Add To Cart</button>
                                    @else
                                        <button type="submit" class="btn btn-primary btn-lg text-center" name="submit"
                                            value="addtocard" style="border-radius: 8px" disabled>Add To Cart</button>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-4 pt-2">
                            @if ($item->role_pembeli == 'Publik')
                            @else
                                @if ($item->role_pembeli != Auth::user()->role_pengguna)
                                    <small class="ml-3" style="color:red;"><i
                                            class="bi bi-info-circle mr-2"></i><em>Produk ini hanya tersedia untuk
                                            {{ $item->role_pembeli }}</em></small>
                                @endif
                            @endif


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Shop Detail End -->
