<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="/dashboard-admin" class="fs-6"><i class="bi bi-grid"></i> Dashboard</a>
    <a href="{{ asset('/kelola-berita') }}" class="fs-6"><i class="bi bi-newspaper"></i> Berita</a>
    <a href="{{ asset('/corousel') }}" class="fs-6"><i class="bi bi-images"></i> Corousel</a>

    <div class="dropdown">
        <a  class="fs-6 dropdown-toggle" id="dropdownMenu" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"><i class="bi bi-people fs-5"></i> Manajemen Pengguna</a>
        <div class="dropdown-menu ml-5" aria-labelledby="dropdownMenu">
            <a href="/kelolapengguna" class="dropdown-item">
                <i class="bi bi-person-gear fs-5"></i><span>Kelola Pengguna</span>
            </a>
            <a href="/kelola-permintaan-roles" class="dropdown-item">
                <i class="bi bi-person-fill-down fs-5"></i><span>Kelola Role Pengguna</span>
            </a>
        </div>
    </div>


    {{-- <a class="nav-link collapsed" data-bs-target="#components-nav-1" data-bs-toggle="collapse" class="fs-6"><i class="bi bi-people"></i> Manajemen Pengguna</a> --}}
    <div class="dropdown">
        <a class="fs-6 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-people"></i> Manajemen Produk
        </a>
        <div class="dropdown-menu ml-5" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="/produks"><i class="bi bi-box2-fill fs-5"></i><span> Kelola Produk</span></a>
            <a class="dropdown-item" href="/kategoriproduk"><i class="bi bi-box-seam-fill fs-5 "></i><span> Kelola
                    Kategori Produk</span></a>
            <a class="dropdown-item" href="/kelola-permintaan-roles"><i class="bi bi-clipboard-pulse fs-5 "></i><span>
                    Detail Penjualan Produk</span></a>
        </div>
    </div>
    <a href="/kelola-metode-pembayaran" class="fs-6"><i class="bi bi-wallet2 fs-5"></i> Kelola Metode Pembayaran</a>
    <a href="/kelola-pesanan" class="fs-6"><i class="bi bi-wallet2 fs-5"></i> Kelola Pesanan</a>
    <a href="/laporan-custom" class="fs-6"><i class="bi bi-journal-text fs-5"></i> Laporan Penjualan</a>
</div>

{{-- <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="/dashboard-admin"><i class="bi bi-grid"></i> Dashboard</a>
    <a href="{{asset('/kelola-berita')}}"><i class="bi bi-newspaper"></i> Berita</a>
    <a href="{{asset('/corousel')}}"><i class="bi bi-images"></i> Corousel</a>
    <a href="/kelolapengguna"><i class="bi bi-person-gear fs-5"></i> Kelola Pengguna</a>
    <a class="nav-link collapsed" data-bs-target="#components-nav-1" data-bs-toggle="collapse"><i class="bi bi-people"></i>Manajemen Pengguna</a>
    <ul id="components-nav-2" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="/produks">
                <i class="bi bi-box2-fill fs-5"></i><span>Kelola Produk</span>
            </a>
        </li>
        <li>
            <a href="/kategoriproduk">
                <i class="bi bi-box-seam-fill fs-5 "></i><span>Kelola Kategori Produk</span>
            </a>
        </li>
    </ul>
    <a href="/kelola-metode-pembayaran"><i class="bi bi-wallet2 fs-5"></i> Kelola Metode Pembayaran</a>
    <a href="/kelola-pesanan"><i class="bi bi-wallet2 fs-5"></i> Kelola Pesanan</a>
    <a href="/laporan-custom"><i class="bi bi-journal-text fs-5"></i> Laporan Penjualan</a>
</div> --}}

{{-- <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn"></a>
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="/dashboard-admin">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{asset('/kelola-berita')}}">
                <i class="bi bi-newspaper"></i>
                <span>Berita</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{asset('/corousel')}}">
                <i class="bi bi-images"></i>
                <span>Corousel</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav-1" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>Manajemen Pengguna</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav-1" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/kelolapengguna">
                        <i class="bi bi-person-gear fs-5"></i><span>Kelola Pengguna</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav-2" data-bs-toggle="collapse" href="#">
                <i class="bi bi-boxes"></i><span>Manajemen Produk</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav-2" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/produks">
                        <i class="bi bi-box2-fill fs-5"></i><span>Kelola Produk</span>
                    </a>
                </li>
                <li>
                    <a href="/kategoriproduk">
                        <i class="bi bi-box-seam-fill fs-5 "></i><span>Kelola Kategori Produk</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav-3" data-bs-toggle="collapse" href="#">
                <i class="bi bi-boxes"></i><span>Manajemen Metode Pembayaran</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav-3" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/kelola-metode-pembayaran">
                        <i class="bi bi-wallet2 fs-5"></i><span>Kelola Metode Pembayaran</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav-4" data-bs-toggle="collapse" href="#">
                <i class="bi bi-bag"></i><span>Manajemen Pesanan</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav-4" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/kelola-pesanan">
                        <i class="bi bi-wallet2 fs-5"></i><span>Kelola Pesanan</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav-5" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Manajemen Penjualan</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav-5" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/laporan-custom">
                        <i class="bi bi-journal-text fs-5"></i><span>Laporan Penjualan</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div> --}}
