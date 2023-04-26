@extends('layouts.frontend-pembeli')
@section('title', 'Del Shop')
@section('navbar')
    @include('layouts.inc.front-navbar')
@endsection
@section('carousel')
    @include('layouts.inc.corousel')
@endsection
@section('content')

<!-- Kategori Start -->
<div class="container-fluid py-5">
    <div class="container-fluid">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="mb-5">KATEGORI <span class="text-primary text-uppercase">Produk</span></h1>
        </div>
        <div class="row kategori text-center justify-content-center">
            @foreach ($kategori as $data)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 10px;" >
                    <a href="/produk/{{ $data->kategori }}" class="cat-img position-relative text-center overflow-hidden mb-3">
                        <img class="img-fluid" src="/category-images/{{ $data->gambar_kategori }}" alt="">
                    </a>
                    <div class="card-body">
                        <h3 class="card-title">{{ $data->kategori }}</h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Kategori End -->



    <!-- Featured Product Start -->
    <div class="featured-product product">
        <div class="container-fluid">
            <div class="section-header text-center wow fadeInUp" data-wow-delay="0.1s">
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
                    <div class="product-item shadow">
                        <div class="product-image shadow">
                            <a href="/detail-produk/{{ $data->id_produk }}">
                                <img src="/product-images/{{ $data->gambar_produk }}" alt="Product Image" >
                            </a>
                            <a href="/detail-produk/{{ $data->id_produk }}">
                                <div class="product-action">
                                </div>
                            </a>
                        </div>
                        <div class="product-price text-center">
                            <h5 class="text-light border-bottom">{{ $data->nama_produk }}</h5><br>
                            <h4 class="text-light" ><span>Rp.</span><?php
                                $angka = $data->harga;
                                echo number_format($angka, 0, ',', '.');
                                ?>
                            </h4 >
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="row align-items-center product-slider product-slider-1 wow zoomIn" data-wow-delay="0.1s">
                @foreach ($unggulan as $data)
                <div class="col-md-3">
                    <div class="product-item shadow">
                        <div class="product-image shadow">
                            <a href="/detail-produk/{{ $data->id_produk }}">
                                <img src="/product-images/{{ $data->gambar_produk }}" alt="Product Image" >
                            </a>
                            <a href="/detail-produk/{{ $data->id_produk }}">
                                <div class="product-action">
                                </div>
                            </a>
                        </div>
                        <div class="product-price text-center">
                            <h5 class="text-light border-bottom">{{ $data->nama_produk }}</h5><br>
                            <h4 class="text-light" ><span>Rp.</span><?php
                                $angka = $data->harga;
                                echo number_format($angka, 0, ',', '.');
                                ?>
                            </h4 >
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
