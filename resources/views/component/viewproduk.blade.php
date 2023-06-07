<!-- Page Header Start -->
<div class="container-fluid ">
    <div class="row px-xl-5 mt-3">
        <div class="col-lg">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Produk</li>

                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Shop Start -->
<div class="container-fluid pt-4">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-12">
            <!-- Size Start -->
            <div class="mb-5">
                <h5 class="font-weight-semi-bold mb-4">Ukuran</h5>
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="size-all">
                        <label class="custom-control-label" for="size-all">Semua Ukuran</label>
                        <!-- <span class="badge border font-weight-normal">1000</span> -->
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="size-1">
                        <label class="custom-control-label" for="size-1">XS</label>
                        <!-- <span class="badge border font-weight-normal">150</span> -->
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="size-2">
                        <label class="custom-control-label" for="size-2">S</label>
                        <!-- <span class="badge border font-weight-normal">295</span> -->
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="size-3">
                        <label class="custom-control-label" for="size-3">M</label>
                        <!-- <span class="badge border font-weight-normal">246</span> -->
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="size-4">
                        <label class="custom-control-label" for="size-4">L</label>
                        <!-- <span class="badge border font-weight-normal">145</span> -->
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" id="size-5">
                        <label class="custom-control-label" for="size-5">XL</label>
                        <!-- <span class="badge border font-weight-normal">168</span> -->
                    </div>
                </form>
            </div>
            <!-- Size End -->

            <!-- Categories -->
            <div class="mb-5">
                <h5 class="font-weight-semi-bold mb-4">Kategori</h5>

                @foreach ($kategori as $cat)
                    <div class="list-group">
                        {{-- <a class="dropdown-item" href="{{ route('items.index', ['sort'=>'all']) }}">All Produk</a> --}}
                        @guest
                        <a href="{{ route('aproducts.category', $cat->kategori) }}"
                            class="list-group-item list-group-item-action">{{ $cat->kategori }}</a>
                        @else
                        <a href="{{ route('products.category', $cat->kategori) }}"
                            class="list-group-item list-group-item-action">{{ $cat->kategori }}</a>
                        @endguest
                    </div>
                @endforeach
            </div>
            <!-- End Categories -->
        </div>
        <!-- Shop Sidebar End -->

        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-12">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        @guest
                            <form action="/glist-produk/cari" method="GET">
                            @else
                                <form action="/list-produk/cari" method="GET">
                                @endguest
                                    <div class="input-group-append">
                                        <input type="text" class="form-control" id="inputModalSearch"
                                            name="cari" placeholder="Search by Name">
                                        <button type="submit" class="input-group-text bg-primary text-light">
                                            <i class="fa fa-fw fa-search text-white"></i>
                                        </button>
                                    </div>
                                </form>
                            <div class="dropdown ml-4">
                                <button class="btn border dropdown-toggle" type="button" id="triggerId"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Sort by
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                    @guest
                                    <a class="dropdown-item"
                                        href="{{ route('gitems.index', ['sort' => 'all']) }}">All
                                        Produk</a>
                                    <a class="dropdown-item"
                                        href="{{ route('gitems.index', ['sort' => 'latest']) }}">Terbaru</a>
                                    <a class="dropdown-item"
                                        href="{{ route('gitems.index', ['sort' => 'termahal']) }}">Termahal</a>
                                    <a class="dropdown-item"
                                        href="{{ route('gitems.index', ['sort' => 'termurah']) }}">Termurah</a>
                                    @else
                                    <a class="dropdown-item"
                                        href="{{ route('items.index', ['sort' => 'all']) }}">All
                                        Produk</a>
                                    <a class="dropdown-item"
                                        href="{{ route('items.index', ['sort' => 'latest']) }}">Terbaru</a>
                                    <a class="dropdown-item"
                                        href="{{ route('items.index', ['sort' => 'termahal']) }}">Termahal</a>
                                    <a class="dropdown-item"
                                        href="{{ route('items.index', ['sort' => 'termurah']) }}">Termurah</a>
                                    @endguest

                                </div>
                            </div>
                </div>
            </div>
            @foreach ($produk as $item)
                <div class="col-sm-3 pb-1 view">
                    <div class="card-group product-item border-0 mb-3">
                        <div class="card">
                            <div
                                class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src="/product-images/{{ $item->gambar_produk }}"
                                    style="min-height: 200px">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 ">
                                <div class="col-12 mt-3" style="text-align: center">
                                    <small class="text-truncate mb-3">{{ $item->nama_produk }}</small>
                                    <div class="d-flex justify-content-center">
                                        <h6>Rp. <?php
                                        $angka = $item->harga;
                                        echo number_format($angka, 0, ',', '.');
                                        ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex bg-light border justify-content-center">
                                <small><a href="/detail-produk/{{ $item->id_produk }}"
                                        class="btn btn-sm text-dark p-0">
                                        <i class="fas fa-eye text-secondary mr-1"></i> <small>View
                                            Detail</small></a>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Shop Product End -->
</div>
</div>
<!-- Shop End -->
