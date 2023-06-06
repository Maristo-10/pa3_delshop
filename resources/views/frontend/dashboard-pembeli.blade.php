@extends('layouts.frontend-pembeli')
@section('title', 'Del Shop')
@section('navbar')
    @include('layouts.inc.front-navbar')
@endsection
@section('carousel')
    @include('layouts.inc.corousel')
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center text-center mt-5">
            <h1 class="">KATEGORI <span class="text-primary text-uppercase">Produk</span></h1>
        </div>
        <div class="row">
            <div class="kategoris">
                @foreach ($kategori as $data)
                <div class="element-card">
                    <div class="front-facing text-center">
                        <img src="/category-images/{{ $data->gambar_kategori }}" alt="" width="110px" height="100px" class="mt-3">
                        <p class="title">{{ $data->kategori }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Start Banner Hero -->
    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active" style="display:none" ></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1" style="display:none"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2" style="display:none"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="/berita-images/{{ $berita->image}}" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1 text-primary">{{$berita->title}}</h1>
                                <h3 class="h2">{{$berita->subtitle}}</h3>
                                <p>
                                    {{$berita->description}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($berita_2 as $data)
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="/berita-images/{{$data->image}}" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1 text-primary">{{ $data->title}}</h1>
                                <h3 class="h2">{{ $data->subtitle}}</h3>
                                <p>
                                    {{ $data->description}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
    <!-- End Banner Hero -->

    <!-- Featured Product Start -->
    <div class="featured-product product">
        <div class="container-fluid">
            <div class="mt-3 mb-5 text-center wow fadeInUp" data-wow-delay="0.1s">
                <h1 class=" text-uppercase">Daftar <span class="text-primary text-uppercase">Produk</span></h1>
            </div>
            @foreach ($total_ung as $item)
            @php
                $total = $item->total;
            @endphp
            @if ($total >= 4)
            <div class="row align-items-center product-slider product-slider-4 wow zoomIn" data-wow-delay="0.1s">
                @foreach ($unggulan as $data)
                <div class="col-sm-3">
                    <div class="product-item  ">
                        <div class="product-image">
                            <a href="/detail-produk/{{ $data->id_produk }}">
                                <img src="/product-images/{{ $data->gambar_produk }}" alt="Product Image" style="min-height: 300px">
                            </a>
                            <a href="/detail-produk/{{ $data->id_produk }}">
                                <div class="product-action">
                                </div>
                            </a>
                        </div>
                        <div class="thumb-content text-center mt-3">
                            <h4>{{ $data->nama_produk }}</h4>
                            <p class="item-price"><span class="text-primary"> Rp.
                                <?php
                                $angka = $data->harga;
                                echo number_format($angka, 0, ',', '.');
                                ?>
                            </span></p>
                            <a href="/detail-produk/{{$data->id_produk}}" class="btn btn-secondary">Lihat Produk</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="row align-items-center product-slider product-slider-1 wow zoomIn" data-wow-delay="0.1s">
                @foreach ($unggulan as $data)
                <div class="col-sm-3">
                    <div class="product-item">
                        <div class="product-image">
                            <a href="/detail-produk/{{ $data->id_produk }}">
                                <img src="/product-images/{{ $data->gambar_produk }}" alt="Product Image" style="min-height: 300px">
                            </a>
                            <a href="/detail-produk/{{ $data->id_produk }}">
                                <div class="product-action">
                                </div>
                            </a>
                        </div>
                        <div class="thumb-content text-center mt-3">
                            <h4>{{ $data->nama_produk }}</h4>
                            <p class="item-price"><span class="text-primary"> Rp.
                                <?php
                                $angka = $data->harga;
                                echo number_format($angka, 0, ',', '.');
                                ?>
                            </span></p>
                            <a href="#" class="btn btn-secondary">Add to Cart</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    @endforeach
    </div>
    <!-- Featured Product End -->

@endsection
