@extends('layouts.frontend-pembeli')
@section('title', 'Del Shop')
@section('navbar')
    @include('layouts.inc.front-navbar')
@endsection
@section('carousel')
    @include('layouts.inc.corousel')
@endsection
@section('content')
    <!-- Categories Start -->
    <div class="container-fluid pt-2 ">
        <div class="row justify-content-center mb-4 mt-4">
            <h1>Kategori Produk</h1>
        </div>
        <div class="container">
            <div class="row pb-3 ">
                @foreach ($kategori as $data)
                    <div class="col-lg-3 col-md-3 pb-1 col-12">
                        <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                            <!-- <p class="text-right">15 Products</p> -->
                            <a href="/produk/{{ $data->kategori }}" class="cat-img text-center overflow-hidden mb-3">
                                <img class="img-fluid" style="height:230px"
                                    src="/category-images/{{ $data->gambar_kategori }}" alt="">
                            </a>
                            <h3 class="font-weight-semi-bold text-center m-0">{{ $data->kategori }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- <div class="col-lg-4 col-md-6 pb-1">
                                                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                                                    <p class="text-right">15 Products</p>
                                                    <a href="" class="cat-img position-relative overflow-hidden mb-3">
                                                        <img class="img-fluid" src="img/cat-4.jpg" alt="">
                                                    </a>
                                                    <h5 class="font-weight-semi-bold m-0">Accerssories</h5>
                                                </div>
                                            </div> -->
        <!-- <div class="col-lg-3"></div>
                                            <div class="col-lg-6 col-md-6 pb-1">
                                                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                                                    <p class="text-right">15 Products</p>
                                                    <a href="" class="cat-img position-relative text-center overflow-hidden mb-3">
                                                        <img class="img-fluid" src="img/cat-5.jpg" alt="">
                                                    </a>
                                                    <h5 class="font-weight-semi-bold text-center m-0">Bags</h5>
                                                </div>
                                            </div> -->
        <!-- <div class="col-lg-4 col-md-6 pb-1">
                                                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                                                    <p class="text-right">15 Products</p>
                                                    <a href="" class="cat-img position-relative overflow-hidden mb-3">
                                                        <img class="img-fluid" src="img/cat-6.jpg" alt="">
                                                    </a>
                                                    <h5 class="font-weight-semi-bold m-0">Shoes</h5>
                                                </div>
                                            </div> -->
    </div>
    </div>
    <!-- Categories End -->


    <!-- Offer Start -->
    <!-- <div class="container-fluid offer pt-5">
                                        <div class="row px-xl-5 justify-content-center mb-2">
                                            <div class="col-md-6 pb-4">
                                                <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                                                    <img src="img/kaos.png" alt="">
                                                    <div class="position-relative" style="z-index: 1;">
                                                        <h5 class="text-primary text-light mb-3">20% off the all order</h5>
                                                        <h1 class="mb-4 text-secondary font-weight-semi-bold">Spring Collection</h1>
                                                        <a href="" class="btn btn-secondary py-md-2 px-md-3">Shop Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 pb-4">
                                                <div class="position-relative bg-primary text-center text-md-left text-white mb-2 py-5 px-5">
                                                    <img src="img/offer-2.png" alt="">
                                                    <div class="position-relative" style="z-index: 1;">
                                                        <h5 class="text-uppercase text-light mb-3">20% off the all order</h5>
                                                        <h1 class="mb-4 font-weight-semi-bold">Winter Collection</h1>
                                                        <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
    <!-- Offer End -->

    <!--Slider-->
    <!-- <div class="slide-container swiper">
                                        <div class="slide-content">
                                            <div class="card-wrapper swiper-wrapper">
                                                <div class="card swiper-slide">
                                                    <div class="image-content">
                                                        <div class="card-image">
                                                            <img src="img//profile1.jpg" alt="" class="card-img">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="card swiper-slide">
                                                    <div class="image-content">
                                                        <div class="card-image">
                                                            <img src="img//profile2.jpg" alt="" class="card-img">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="card swiper-slide">
                                                    <div class="image-content">
                                                        <div class="card-image">
                                                            <img src="img//profile3.jpg" alt="" class="card-img">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="card swiper-slide">
                                                    <div class="image-content">
                                                        <div class="card-image">
                                                            <img src="img//profile4.jpg" alt="" class="card-img">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="card swiper-slide">
                                                    <div class="image-content">
                                                        <div class="card-image">
                                                            <img src="img//profile5.jpg" alt="" class="card-img">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="card swiper-slide">
                                                    <div class="image-content">
                                                        <div class="card-image">
                                                            <img src="img//profile6.jpg" alt="" class="card-img">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="card swiper-slide">
                                                    <div class="image-content">
                                                        <div class="card-image">
                                                            <img src="img//profile7.jpg" alt="" class="card-img">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="card swiper-slide">
                                                    <div class="image-content">
                                                        <div class="card-image">
                                                            <img src="img//profile8.jpg" alt="" class="card-img">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="card swiper-slide">
                                                    <div class="image-content">
                                                        <div class="card-image">
                                                            <img src="img/" alt="" class="card-img">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-button-next swiper-navBtn"></div>
                                        <div class="swiper-button-prev swiper-navBtn"></div>
                                        <div class="swiper-pagination"></div>
                                    </div> -->
    <!--End Slider-->

    <!-- Featured Product Start -->
    <div class="featured-product product">
        <div class="container-fluid">
            <div class="section-header text-center">
                <h1>Produk Unggulan</h1>
            </div>
            @foreach ($total_ung as $item)
                @php
                    $total = $item->total;
                @endphp
                @if ($total >= 4)
                    <div class="row align-items-center product-slider product-slider-4">
                        @foreach ($unggulan as $data)
                            <div class="col-lg-3">
                                <div class="product-item col-12">
                                    <div class="product-title">
                                        <a href="/detail-produk/{{ $data->id_produk }}">{{ $data->nama_produk }}</a>
                                    </div>
                                    <div class="product-image">
                                        <a href="/detail-produk/{{ $data->id_produk }}">
                                            <img src="/product-images/{{ $data->gambar_produk }}" alt=""
                                                style="height: 350px">
                                        </a>
                                        <div class="product-action">
                                            <a href="/detail-produk/{{ $data->id_produk }}"><i
                                                    class="fa fa-cart-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-price col-12">
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <h6><span>Rp.</span><?php
                                                $angka = $data->harga;
                                                echo number_format($angka, 0, ',', '.');
                                                ?></h6>
                                            </div>

                                            <div class="col-lg-7 float-right" style="text-align: right">
                                                <a class="btn" href="/detail-produk/{{ $data->id_produk }}"><small><i
                                                            class="fa fa-shopping-cart"></i>Buy Now</small></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="row align-items-center product-slider product-slider-1">
                        @foreach ($unggulan as $data)
                            <div class="col-lg-3">
                                <div class="product-item col-12">
                                    <div class="product-title">
                                        <a href="/detail-produk/{{ $data->id_produk }}">{{ $data->nama_produk }}</a>
                                    </div>
                                    <div class="product-image">
                                        <a href="/detail-produk/{{ $data->id_produk }}">
                                            <img src="/product-images/{{ $data->gambar_produk }}" alt=""
                                                style="height: 350px">
                                        </a>
                                        <div class="product-action">
                                            <a href="/detail-produk/{{ $data->id_produk }}"><i
                                                    class="fa fa-cart-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-price col-12">
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <h6><span>Rp.</span><?php
                                                $angka = $data->harga;
                                                echo number_format($angka, 0, ',', '.');
                                                ?></h6>
                                            </div>

                                            <div class="col-lg-7 float-right" style="text-align: right">
                                                <a class="btn" href="/detail-produk/{{ $data->id_produk }}"><small><i
                                                            class="fa fa-shopping-cart"></i>Buy Now</small></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach

        </div>
    </div>
    <!-- Featured Product End -->

@endsection
