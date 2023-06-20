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
            @if ($message = Session::get('ok'))
                            <div class="alert alert-warning alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
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

                    <h5 class="mb-4 mt-5">Silahkan Pilih Spesifikasi Produk </h5>
                    <form action="/produk/tambah-keranjang/{{ $item->id_produk }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $item->id_produk }}">
                        <div class="row mb-3">
                            @if ($item->warna != null)
                            <div class="form-group col-12 col-md-6 mt-3">
                                <?php
                                $warnas = $item->warna;
                                ?>
                                <div class="row col-12">
                                    <h5>Warna Yang Tersedia :</h5>
                                    <div class="col">
                                        <select name="warna" id="warna"
                                            class="form-control col-md-12" required>
                                            <option selected disabled>Silahkan Pilih Warna Produk</option>
                                            @foreach (explode(',', $warnas) as $warna)
                                                <option value="{{ $warna }}">{{ $warna }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if ($item->angkatan != null)
                                <div class="form-group col-12 col-md-6 mt-3">
                                    <?php
                                    $angkatans = $item->angkatan;
                                    ?>
                                    <div class="row col-12">
                                        <h5>Angkatan :</h5>
                                        <div class="col">
                                            <select name="angkatan" id="angkatan"
                                                class="form-control col-md-12" required>
                                                <option selected disabled>Silahkan Pilih Angkatan</option>
                                                @foreach (explode(',', $angkatans) as $angkatan)
                                                    <option value="{{ $angkatan }}">{{ $angkatan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($item->ukuran_produk != null)
                            <div class="form-group col-12 col-md-6 mt-3">
                                <?php
                                $ukurans = $item->ukuran_produk;
                                ?>

                                <div class="row col-12">
                                    <h5>Ukuran Yang Tersedia :</h5>
                                </div>
                                <div class="col">
                                    <select name="ukuran" id="ukuran" class="form-control col-md-12" required>
                                        <option selected disabled>Silahkan Pilih Ukuran</option>
                                        @foreach (explode(',', $ukurans) as $ukuran)
                                            <option value="{{ $ukuran }}">{{ $ukuran }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div class="form-group col-12 col-md-6 mt-3">
                                <div class="col-12">
                                    <h5>Jumlah Produk</h5>
                                    <div class="input-group quantity">
                                        <div class="minus changeQuantity" style="cursor: pointer">
                                            <button type="button" class="input-group-text">-</button>
                                        </div>
                                        <input type="number" name="jumlah" id="jumlah"
                                            class="qty-input form-control" value="1">
                                        <div class="plus changeQuantity" style="cursor: pointer">
                                            <button type="button" class="input-group-text">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pb-3">
                            <div class="col-md-6 offset-md-8">
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
                                            class="bi bi-info-circle mr-2"></i><em>Produk
                                            ini
                                            hanya
                                            tersedia untuk
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
