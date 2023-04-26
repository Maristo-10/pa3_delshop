<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="{{ asset('preconnect" href="https://fonts.gstatic.com') }}">
    <link href="{{ asset('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css') }}" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css') }}">
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/slick/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/style2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/a.css') }}">
</head>

<body>
    <!--Navbar Start-->
    <div class="start">
        <!--Navbar Top-->
        <div class="text-right bg-top align-items-center py-2 px-3">
            <a class="text-light px-2" href="">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a class="text-light px-2" href="">
                <i class="fab fa-twitter"></i>
            </a>
            <a class="text-light px-2" href="">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <a class="text-light px-2" href="">
                <i class="fab fa-instagram"></i>
            </a>
            <a class="text-light pl-2" href="">
                <i class="fab fa-youtube"></i>
            </a>
        </div>
        <!--Navbar Utama-->
        <div class="container-fluid mt-3 mb-3">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-3">
                    <div class="logo">
                        <a href="index.html">
                            <img src="{{asset('img/logo.png')}}" alt="Logo" width="150px">
                        </a>
                    </div>
                </a>
            </div>
            <div class="col-lg-5 col-6 text-left">
                <form action="/produk/cari" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="cari" placeholder="Search for products"
                            style="height: 30px">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-1 col-2">
                @guest
                    <a href="/keranjang" class="btn" style="font-size: 20px">
                        <i class="fas fa-shopping-cart text-primary"></i>
                        <span class="badge">0</span>
                    </a>
                @else
                    @empty($pesanan_baru)
                        <a href="/keranjang" class="btn" style="font-size: 20px">
                            <i class="fas fa-shopping-cart text-primary"></i>
                            <span class="badge">0</span>
                        </a>
                    @else
                        <a href="/keranjang" class="btn" style="font-size: 20px">
                            <i class="fas fa-shopping-cart text-primary"></i>
                            @foreach ($pesanan as $a)
                                <span class="badge">{{ $a->total }} </span>
                            @endforeach
                        </a>
                    @endempty
                @endguest


            </div>
            <div class="col-lg-3 col-4 text-right">
                <!-- <a href="" class="btn border">
                    <i class="fas fa-heart text-primary"></i>
                    <span class="badge">0</span>
                </a>
                <a href="" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge">0</span>
                </a> -->
                <ul class="d-flex align-items-center" style="font-size: 15px">
                    <!-- Right -->
                    <ul class="navbar-nav nav-flex-icons ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login') && Route::has('register'))
                                <div class="col-md-12">
                                    <li class="nav-item pe-3">
                                        <button type="button" class="btn btn-sm btn-outline-secondary m-3"
                                            style="font-size: 15px">
                                            <a href="{{ route('login') }}">Masuk</a>
                                        </button>
                                        {{-- <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> --}}
                                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                            style="font-size: 15px">
                                            <a href="{{ route('register') }}">Register</a>
                                        </button>
                                        {{-- <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> --}}
                                    </li>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <div class="login mb-4">
                        @guest

                        @else
                            <!-- Example single danger button -->
                            <div class="btn-group">
                                <a type="button" class="text-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-bell"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <h6 class="dropdown-header">
                                        Alerts Center
                                    </h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-primary">
                                                <i class="fas fa-file-alt text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 12, 2019</div>
                                            <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-success">
                                                <i class="fas fa-donate text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 7, 2019</div>
                                            $290.29 has been deposited into your account!
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-warning">
                                                <i class="fas fa-exclamation-triangle text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 2, 2019</div>
                                            Spending Alert: We've noticed unusually high spending for your account.
                                        </div>
                                    </a>
                                    <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                </ul>
                            </div>
                        @endguest

                        @guest
                            <a href="/keranjang" class="btn mr-3" style="font-size: 20px">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                {{-- <span class="badge">0</span> --}}
                            </a>
                        @else
                            @empty($pesanan_baru)
                                <a href="/keranjang" class="btn" style="font-size: 20px">
                                    <i class="fas fa-shopping-cart text-primary"></i>
                                    <span class="badge">0</span>
                                </a>
                            @else
                                <a href="/keranjang" class="btn" style="font-size: 20px">
                                    <i class="fas fa-shopping-cart text-primary"></i>
                                    @foreach ($pesanan as $a)
                                        <span class="badge">{{ $a->total }} </span>
                                    @endforeach
                                </a>
                            @endempty
                        @endguest
                            @guest
                            @if (Route::has('login') && Route::has('register'))
                            <button type="button" class="btn btn-sm btn-outline-secondary ">
                                <a href="{{ route('login') }}">Masuk</a>
                            </button>
                            {{-- <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> --}}
                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                <a href="{{ route('register') }}">Register</a>
                            </button>
                            @endif
                        @else
                            <li class="nav-item dropdown pe-3">
                                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                                    data-bs-toggle="dropdown" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false" v-pre>
                                    @foreach ($pengguna_prof as $profile)
                                    @php
                                        $profile = $profile->gambar_pengguna;
                                    @endphp
                                        <img src="{{asset("/profile-images/".$profile)}}" alt="Profile"
                                            class="rounded-circle" style="width: 40px; height:40px">
                                    @endforeach

                                    <span class="d-none ">{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <a class="dropdown-item d-flex align-items-center" href="/profile">
                                        <i class="bi bi-person m-2"></i>
                                        <span>My Profile</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right m-2"></i>
                                        <span>{{ __('Logout') }}</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </ul>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="mb-1">
        <div class="row border-top justify-content-center">
            <div class="col-lg-11">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse"
                        data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            @yield('navbar')
                        </div>
                    </div>
                </nav>
                @yield('carousel')
            </div>
        </div>
    </div>

    @yield('carousel')

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-light mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-5 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <div class="logo">
                        <a href="/home">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo" width="150px">
                        </a>
                    </div>
                </a>
                <h5 class="font-weight-bold text-light mb-4 mt-4">Quick Links</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>
                    Institut Teknologi Del
                    Jl. Sisingamangaraja, Sitoluama Laguboti, Toba Samosir Sumatera Utara, Indonesia</p>
                <P>Kode Pos: 22381</P>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@del.ac.id</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+62 632 331234</p>
            </div>
            <div class="col-lg-7 col-md-12">
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <h5 class="font-weight-bold text-light mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-light mb-2" href="/home"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-light mb-2" href="/produk"><i class="fa fa-angle-right mr-2"></i>Produk</a>
                            <a class="text-light mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Tentang
                                Kita</a>
                            <a class="text-light mb-2" href="/keranjang"><i
                                    class="fa fa-angle-right mr-2"></i>Keranjang</a>
                            <a class="text-light" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact
                                Us</a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <h5 class="font-weight-bold text-light mb-4">Partner Del</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-light mb-2" href="/home"><i class="fa fa-angle-right mr-2"></i>IT Del</a>
                            <a class="text-light mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Yayasan
                                Del</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md px-xl-0">
                <p class="mb-md-0 text-center text-light">
                    &copy; <a class="text-light font-weight-semi-bold" href="#">Del Shop</a>. All Rights
                    Reserved.
                    <!-- <a class="text-dark font-weight-semi-bold" href="https://htmlcodex.com">HTML Codex</a> -->
                </p>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>



    <!-- JavaScript Libraries -->
    {{-- <script src="{{ asset('https://code.jquery.com/jquery-3.4.1.min.js') }}"></script> --}}
    <script src="{{ asset('lib/slick/slick.min.js') }}"></script>
    <script src="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>


    <!-- Contact Javascript File -->
    {{-- <script src="{{ asset('mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('mail/contact.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/jquery.js') }}"></script> --}}
    <script src="{{ asset('js/jquery-ui.js') }}"></script>

    <!-- Swiper JS -->
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>

    <!-- JavaScript -->
    <script src="{{ asset('js/script.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main2.js') }}"></script>

    {{-- <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/mdb.min.js') }}"></script>

    <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js') }}"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    {{-- <script src="{{ asset('https://code.jquery.com/jquery-3.5.1.slim.min.js') }}"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script> --}}

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> --}}

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script> {{-- custom js --}}

    {{-- <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js') }}"></script> --}}


    {{-- js maristo and the man --}}
    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    {{-- jquery --}}
    {{-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script> custom js --}}
    <script type="text/javascript" src="{{ asset('assets/js/custom.js') }}"></script>

    {{-- custom.js adding to cart ajax --}}
    {{-- <script type="text/javascript" src="{{ asset('assets/js/custom.js') }}"></script> --}}
    {{-- <script type="text/javascript" src="{{ asset('assets/js/custom.js') }}"></script> --}}
    {{-- end custom.js --}}
    {{-- end - jquery --}}
</body>

</html>
