<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Del Shop</title>
    <!-- Favicons -->
    <link href="{{ asset('profile-images/logo.png') }}" class="rounded-circle" rel="icon">


    <!-- Google Fonts -->
    <link href="{{ asset('https://fonts.gstatic.com') }}" rel="preconnect">
    <link
        href="{{ asset('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i') }}"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('css/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('css/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('css/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('css/stylebaru.css') }}" rel="stylesheet">
    <link href="{{ asset('css/a.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    {{-- font awesome --}}
    <link rel="stylesheet" href="{{ asset('https://use.fontawesome.com/releases/v5.11.2/css/all.css') }}">
    <link rel="stylesheet"
        href="{{ asset('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap') }}">
    {{-- bootstrap core css --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}"> --}}
    {{-- material design bootstrap --}}
    {{-- <link rel="stylesheet" href="{{ asset('/assets/css/mdb.min.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css') }}">
    <script defer src="{{ asset('https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.js') }}"></script>
    <link href="{{ asset('https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css') }}" rel="stylesheet">
    <style>
        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #ffffff;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }
    </style>
    @stack('styles')

</head>

<body id="main">

    <header id="header" class="header d-flex align-items-center">
        @include('layouts.inc.front-navbar-admin')
    </header>

    <div class="side">
        @include('layouts.inc.front-sidebar-admin')
    </div>

    <main id="main" class="main">
        <div class="content-body ">
            <div class="col-md-12 mb-3">
                @yield('title')
            </div>
            <div class="">
                @yield('content')
            </div>
        </div>
    </main>


    @stack('scripts')
    <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/mdb.min.js') }}"></script>

    <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js') }}"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js') }}"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js') }}"
        integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.slim.js') }}"
        integrity="sha512-JC/KiiKXoc40I1lqZUnoRQr96y5/q4Wxrq5w+WKqbg/6Aq0ivpS2oZ24x/aEtTRwxahZ/KOApxy8BSZOeLXMiA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.slim.min.js') }}"
        integrity="sha512-5NqgLBAYtvRsyAzAvEBWhaW+NoB+vARl6QiA02AFMhCWvPpi7RWResDcTGYvQtzsHVCfiUhwvsijP+3ixUk1xw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }
    </script>
</body>

</html>
