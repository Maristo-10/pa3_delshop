<div class="d-flex justify-content-between">
    <a href="/dashboard-admin" class="logo d-flex align-items-center">
        <div class="col-4">
            <img src={{ asset('imageStatis/del-shop.png') }} alt="">
        </div>
        <div class="col-4">
            <span class="d-none d-lg-block pt-3 mx-3">
                <p style="text-align:center">DELSHOP</p>
            </span>
        </div>
    </a>
    <span style="font-size:30px;cursor:pointer" class="mt-1 ml-3 align-items-center" onclick="openNav()" onclick="closeNav()">&#9776;</span>
</div><!-- End Logo -->

<nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

        <a class="dropdown mr-5 mt-2" href="#" role="button" data-bs-toggle="dropdown" style="font-size: 20px"
            aria-expanded="false">
            <i class="fas fa-bell mr-3"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark">
                {{ $count }}
            </span>
        </a>
        {{-- foreach ($notifications as $notification) {
        $data = json_decode($notification->data, true); // Decode the JSON-encoded data property

        if (isset($data['data'])) {
            dd($data['data']);
        }
    } --}}
        <ul class="dropdown-menu">
            @foreach ($notifications as $notification)
                <?php
                $data = json_decode($notification->data, true); // Decode the JSON-encoded data property
                ?>
                @if (isset($data['pesananId']) && isset($data['data']))
                    @if (strpos($data['data'], 'Diproses') !== false)
                        <?php
                        $dataPesanan = $data['data'];
                        $array = explode(' ', $dataPesanan);
                        $mergedValue = implode(' ', array_slice($array, 0, 2));
                        $arrayBaru = explode(' ', $mergedValue);
                        $dataToShow = 'Ada ' . $arrayBaru[0] . ' Baru ID ' . $arrayBaru[1];
                        // $dataToShow = $arrayBaru[1];
                        ?>
                        <li class="justify-content-center">
                            <a class="dropdown-item" href="{{ route('admin.ubahstatus', ['id' => $data['pesananId']]) }}">
                                <div class="d-flex align-items-center">
                                    <p class="fs-6 mb-0 mr-3">{{ $dataToShow }}</p>
                                    {{-- <h1>hello world</h1> --}}
                                    <a href="{{ route('mark-as-read-by-id', ['id' => $notification->id]) }}"
                                        class="btn btn-success btn-sm ml-3" style="font-size: 12px; padding: 4px 8px;">Mark as read</a>
                                </div>
                            </a>
                        </li>

                    @endif
                @else
                    <h4>Tidak ada pesanan</h4>
                @endif
            @endforeach
            {{-- <h1>hello world</h1> --}}
        </ul>

        {{-- <li class="nav-item d-block d-lg-none">
            <a class="nav-link nav-icon search-bar-toggle " href="#">
                <i class="bi bi-search"></i>
            </a>
        </li> --}}
        <!-- End Search Icon-->

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons ml-auto">
            {{-- <li class="nav-item">
                <a class="nav-link waves-effect">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="clearfix d-none d-sm-inline-block"> Cart </span>
                    <span class="badge red z-depth-1 mr-1"> 1 </span>
                </a>
            </li> --}}
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login') && Route::has('register'))
                    <div class="col-md-12">
                        <li class="nav-item pe-3">
                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                <a href="{{ route('login') }}">Masuk</a>
                            </button>
                            {{-- <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> --}}
                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                <a href="{{ route('register') }}">Register</a>
                            </button>
                            {{-- <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> --}}
                        </li>
                    </div>
                @endif
            @else
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown"
                        href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        v-pre>
                        <img src="/imageStatis/admin.png" alt="Profile" class="" style="width: 40px; height:45px">
                        <span class="d-none d-md-block dropdown-toggle ps-2 ml-2">{{ Auth::user()->name }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile p-2"
                        aria-labelledby="navbarDropdown">
                        <div class="container">
                            <a class="dropdown-item d-flex align-items-center"href="/aprofile">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>{{ __('Logout') }}</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </ul>

                    {{-- notification --}}

                </li>
            @endguest
        </ul>
        </div>
        </div>
</nav>
<!-- Navbar -->
