@extends('layouts.frontend-pegawai')

@section('title')
    Home
@endsection

@section('content')

    <section class="py-4">
        <div class="container">
            <div class="row">
                <div style="text-align: center">
                <b><h3>Kategori</h3></b>

                </div>
            </div>
            <div class="row">
                <!--Grid column-->
                @for ($i = 1; $i < 7; $i++)
                    <div class="col-md-2 col-6 mt-3">

                        <!--Card-->
                        <div class="card">

                            <!--Card image-->
                            <div class="view overlay">
                                <a>
                                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/12.jpg" class="card-img-top" alt="">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>
                            <!--Card image-->

                            <!--Card content-->
                            <div class="card-body text-center">
                                <!--Category & Title-->
                                <a href="" class="grey-text">
                                    <h5>Shirt</h5>
                                </a>
                                <h5>
                                    <strong>
                                        <a href="" class="dark-grey-text">Denim shirt
                                            <span class="badge badge-pill danger-color">NEW</span>
                                        </a>
                                    </strong>
                                </h5>

                                <h4 class="font-weight-bold blue-text">
                                    <strong>120$</strong>
                                </h4>
                            </div>

                        </div>
                        <!--Card-->

                    </div>
                @endfor

                <!--Grid column-->
            </div>
        </div>
    </section>
@endsection

