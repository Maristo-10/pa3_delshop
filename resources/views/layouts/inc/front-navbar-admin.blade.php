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
                        <img src="/imageStatis/admin.png" alt="Profile" class=""
                            style="width: 40px; height:45px">
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
                </li>
            @endguest
        </ul>
        </div>
        </div>
</nav>
<!-- Navbar -->
