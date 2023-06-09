@push('scripts')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            const toggleBtn = document.querySelector(".toggle-sidebar-btn");
            const sidebar = document.querySelector(".sidebar");

            toggleBtn.addEventListener("click", function() {
                sidebar.classList.toggle("active");
            });
        });
    </script>
@endpush
<style>
    .sidebar.active {
        display: none;
    }
    .sidebar {
        display: block;
    }
</style>
<div class="d-flex align-items-center justify-content-between">
    <a href="/dashboard" class="logo d-flex align-items-center">
        <div class="col-4">
            <img src={{ asset('imageStatis/del-shop.png') }} alt="" style="width: 80px; max-height:80px; ">
        </div>
        <div class="col-4">
            <span class="d-none d-lg-block mt-3">
                <p style="text-align:center">DELSHOP</p>
            </span>
        </div>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

{{-- <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
</div> --}}

<nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
            <a class="nav-link nav-icon search-bar-toggle " href="#">
                <i class="bi bi-search"></i>
            </a>
        </li><!-- End Search Icon-->

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
