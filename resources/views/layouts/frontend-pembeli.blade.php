<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="{{ asset('preconnect" href="https://fonts.gstatic.com') }}">
    <link
        href="{{ asset('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap') }}"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css') }}"
        rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css') }}"
        rel="stylesheet">
    <link rel="stylesheet"
        href="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css') }}">
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('lib/slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/slick/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/style2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/a.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/templatemo.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    @stack('styles');
</head>

<body>
    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-secondary navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none"
                        href="mailto:info@company.com">itdel@gmail.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">010-020-0340</a>
                </div>
                <div>
                    <a class="text-light" href="https://fb.com/templatemo" target="_blank" rel="sponsored"><i
                            class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.instagram.com/" target="_blank"><i
                            class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://twitter.com/" target="_blank"><i
                            class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.linkedin.com/" target="_blank"><i
                            class="fab fa-linkedin fa-sm fa-fw"></i></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->


    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light border-bottom ">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand text-success logo h1 align-self-center" href="/">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" width="90px">
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="align-self-center collapse navbar-collapse d-lg-flex" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-end">
                        <a href="{{ asset('/home') }}" class="nav-item nav-link">Home</a>
                        @guest
                        <a href="{{ asset('/glist-produk') }}" class="nav-item nav-link">Produk</a>
                        @else
                        <a href="{{ asset('/list-produk') }}" class="nav-item nav-link">Produk</a>
                        @endguest
                        <a href="{{ asset('/pesanan') }}" class="nav-item nav-link">Pesanan</a>
                        <a href=""></a>
                    </ul>
                </div>

                <!-- Modal -->
                <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="w-100 pt-1 mb-5 text-right">
                            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Close</button> --}}
                        </div>
                        @guest
                        <form action="/gproduk/cari" method="get" class="modal-content modal-body border-0 p-0">
                            @else
                            <form action="/produk/cari" method="get" class="modal-content modal-body border-0 p-0">
                            @endguest
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="inputModalSearch" name="cari"
                                    placeholder="Search ...">
                                <button type="submit" class="input-group-text bg-success text-light">
                                    <i class="fa fa-fw fa-search text-white"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="navbar align-self-center d-flex">
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-sm-auto">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch"
                                placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal"
                        data-bs-target="#templatemo_search">
                        <i class="fa fa-fw fa-search text-dark mr-2"></i>
                    </a>
                    @guest

                        @else
                        <div class="dropdown mr-2">
                            <a class="dropdown position-relative" href="#" role="button"
                                data-bs-toggle="dropdown" style="font-size: 20px" aria-expanded="false">
                                <i class="fas fa-bell mr-3"></i>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                                {{-- <span class="badge badge-light bg-dark text-light badge-xs">{{ auth()->user()->unreadNotifications->count() }}</span> --}}
                            </a>

                            <ul class="dropdown-menu">
                                @if (auth()->user()->unreadNotifications)
                                <li>
                                    <a href="{{ route('mark-as-read') }}"
                                        class="text-light text-center dropdown-item bg-primary">Tandai Sudah Dibaca</a>
                                    <span class="visually-hidden">unread messages</span>
                                </li>
                                @endif
                                {{-- @foreach (auth()->user()->unreadNotifications as $notification)
                                    <li><a class="dropdown-item " href="{{ route('mark-as-read-by-id', ['id' => $notification->id]) }}">
                                        <small>{{ $notification->data['data'] }}</small>
                                    </a></li>
                                @endforeach --}}
                                @foreach (auth()->user()->unreadNotifications as $notification)

                                    {{-- <li><a class="dropdown-item " href="{{ route('mark-as-read-by-id', ['id' => $notification->id]) }}"> --}}
                                    {{-- <li class="dropdown-item"> --}}
                                        @if (isset($notification->data['pesananId']))


                                        <li><a class="dropdown-item " href="{{ route('pembeli.detailpesanan', ['id' => $notification->data['pesananId']]) }}">

                                            {{-- href="/detail-pesanan/{{ $data->id }}" --}}
                                            {{-- @if(isset($notification->data['status']))
                                                    --- {{ $notification->data['status'] }}
                                                @endif --}}
                                            <small>{{ $notification->data['data'] }}</small>
                                            {{-- @if (isset($notification->data['status']))
                                                @if ($notification->data['status'] == 'Siap Diambil')
                                                    <a class="dropdown-item " href="{{ route('pembeli.pesanan') }}">
                                                        <small>{{ $notification->data['data'] }}</small>
                                                    </a>
                                                @else
                                                    <h1>ini else nya</h1>
                                                @endif
                                            @endif --}}

                                        </a></li>
                                    @endif
                                @endforeach
                                {{-- <li>
                                    @foreach (auth()->user()->readNotifications as $notification)
                                    <a href="#" class="dropdown-item">
                                        <small><li class="text-secondary"> {{ $notification->data['data'] }}</li></small>
                                    </a>
                                    @endforeach
                                </li> --}}
                            </ul>
                        </div>
                    @endguest

                    @guest
                        <a href="/keranjang" class="btn" style="font-size: 20px">
                            <i class="fas fa-shopping-cart text-primary"></i>
                        </a>
                    @else
                        @empty($pesanan_baru)
                            <a href="/keranjang" type="button" class="btn position-relative mr-2" style="font-size: 20px">
                                <i class="fas fa-shopping-cart text-dark"></i>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark mt-2">
                                    0
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </a>
                        @else
                            <a class="nav-icon position-relative text-decoration-none ml-2 mr-4 text-dark" href="/keranjang">
                                <i class="fa fa-fw fa-cart-arrow-down mr-1"></i>
                                @foreach ($pesanan as $a)
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark">
                                        {{ $a->total }}
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                    {{-- <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">{{ $a->total }}</span> --}}
                                    @endforeach

                                </a>
                            @endempty
                        @endguest

                    @guest
                        @if (Route::has('login') && Route::has('register'))
                            <button type="button" class="btn btn-sm btn-outline-secondary ml-3">
                                <a href="{{ route('login') }}">Masuk</a>
                            </button>
                        @endif
                    @else
                        <div class="btn-group">
                            <a type="button" class="text-dark ml-2 mr-3" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                @foreach ($pengguna_prof as $profile)
                                    @php
                                        $profile = $profile->gambar_pengguna;
                                    @endphp
                                    <img src="{{ asset('/profile-images/' . $profile) }}" alt="Profile"
                                        class="rounded-circle border" style="width: 40px; height:40px">
                                @endforeach

                                <span class="d-none ">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <a class="dropdown-item d-flex align-items-center" href="/profile">
                                    <i class="bi bi-person mb-2 mt-2"></i>
                                    <span>My Profile</span>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right mb-2 mt-2"></i>
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
    </nav>
    <!-- Close Header -->

    @yield('carousel')

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-light mt-5 pt-5">
        <div class="row px-xl-3 pt-2">
            <div class="col-lg-5 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <div class="logo">
                        <a href="/home">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo" width="120px">
                        </a>
                    </div>
                </a>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3 mt-4"></i>
                    Institut Teknologi Del
                    Jl. Sisingamangaraja, Sitoluama Laguboti, Toba Samosir Sumatera Utara, Indonesia</p>
                <P>Kode Pos: 22381</P>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@del.ac.id</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+62 632 331234</p>
            </div>
            <div class="col-lg-7 col-md-12">
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <h5 class="font-weight-bold text-light mb-2">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-light mb-1" href="/home"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-light mb-1" href="/produk"><i
                                    class="fa fa-angle-right mr-2"></i>Produk</a>
                            {{-- <a class="text-light mb-1" href="#"><i class="fa fa-angle-right mr-2"></i>Tentang
                                Kita</a> --}}
                            <a class="text-light mb-1" href="/keranjang"><i
                                    class="fa fa-angle-right mr-2"></i>Keranjang</a>
                            <a class="text-light" href="/pesanan"><i class="fa fa-angle-right mr-2"></i>Pesanan</a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <h5 class="font-weight-bold text-light mb-2">Partner Del</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-light mb-1" href="/home"><i class="fa fa-angle-right mr-2"></i>IT
                                Del</a>
                            <a class="text-light mb-1" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Yayasan
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
    <script src="{{ asset('https://code.jquery.com/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('lib/slick/slick.min.js') }}"></script>
    <script src="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Swiper JS -->
    <script src="{{ asset('js/swiper-bunle.min.js') }}"></script>

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
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

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
