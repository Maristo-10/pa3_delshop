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
        <div class="col-lg-2 col-md-12">
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

            <!-- Price Start -->
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Harga</h5>
                <form>
                    <div class="input-group input-group-sm mb-3 row ">
                        <div class="col">
                            <input type="text" name="Min" class="form-control border" placeholder="Min"
                                id="">
                        </div>
                        <p>-</p>
                        <div class="col">
                            <input type="text" name="Max" class="form-control border" placeholder="Max"
                                id="">
                        </div>
                    </div>
                    <div class="custom-control align-items-center justify-content-between mb-3 row">
                        <div class="col">
                            <button type="button" class="btn btn-secondary btn-sm">50RB-100RB</button>
                            <button type="button" class="btn btn-secondary btn-sm">100RB-200RB</button>
                        </div>
                    </div>
                    <div class="custom-control align-items-center mb-3 row">
                        <div class="col">
                            <button type="button" class="btn btn-secondary btn-sm">50RB-100RB</button>
                            <button type="button" class="btn btn-secondary btn-sm">100RB-200RB</button>
                        </div>
                    </div>
                    <!-- <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="price-all">
                            <label class="custom-control-label" for="price-all">All Price</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-1">
                            <label class="custom-control-label" for="price-1">$0 - $100</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-2">
                            <label class="custom-control-label" for="price-2">$100 - $200</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-3">
                            <label class="custom-control-label" for="price-3">$200 - $300</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-4">
                            <label class="custom-control-label" for="price-4">$300 - $400</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="price-5">
                            <label class="custom-control-label" for="price-5">$400 - $500</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div> -->
                </form>
            </div>
            <!-- Price End -->

            <!-- Categories -->
            <div class="mb-5">
                <h5 class="font-weight-semi-bold mb-4">Kategori</h5>
                <ul class="list-group list-group-flush">
                    <div class="row col-md-12">
                        @foreach ($kategori as $cat)
                            <div>
                                <li class="list-group-item"><a href="">{{ $cat->kategori }}</a></li>
                            </div>
                        @endforeach
                    </div>
                </ul>
            </div>
            <!-- End Categories -->

            <!-- Color Start -->
            <!-- <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by color</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="color-all">
                            <label class="custom-control-label" for="price-all">All Color</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-1">
                            <label class="custom-control-label" for="color-1">Black</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-2">
                            <label class="custom-control-label" for="color-2">White</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-3">
                            <label class="custom-control-label" for="color-3">Red</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-4">
                            <label class="custom-control-label" for="color-4">Blue</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="color-5">
                            <label class="custom-control-label" for="color-5">Green</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div> -->
            <!-- Color End -->

        </div>
        <!-- Shop Sidebar End -->

        <!-- Shop Product Start -->
        <div class="col-lg-10 col-md-12">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search by name">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-transparent text-secondary">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <div class="dropdown ml-4">
                            <button class="btn border dropdown-toggle" type="button" id="triggerId"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sort by
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                <a class="dropdown-item" href="#">Latest</a>
                                <a class="dropdown-item" href="#">Popularity</a>
                                <a class="dropdown-item" href="#">Best Rating</a>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($produk as $item)
                    <div class="col-sm-4 pb-1 view">
                        <div class="card product-item border-0 mb-3">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src="/product-images/{{ $item->gambar_produk }}">
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
                                <small><a href="/detail-produk/{{ $item->id_produk }}" class="btn btn-sm text-dark p-0">
                                    <i class="fas fa-eye text-secondary mr-1"></i>View Detail</a>
                                </small>
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
