<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link " href="/dashboard-admin">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
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
            {{-- <li>
                <a href="">
                    <i class="bi bi-person-fill-x fs-5"></i><span>Pengguna Non-Aktif</span>
                </a>
            </li> --}}

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
                <a href="/produks/non-aktif">
                    <i class="bi bi-box2 fs-5"></i><span>Produk Non-Aktif</span>
                </a>
            </li>
            <li>
                <a href="/kategoriproduk">
                    <i class="bi bi-box-seam-fill fs-5"></i><span>Kelola Kategori Produk</span>
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
            <li>
                <a href="/kelola-metode-pembayaran">
                    <i class="bi bi-wallet-fill fs-5"></i><span>Kelola Kategori Pembayaran</span>
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
                <a href="/laporan">
                    <i class="bi bi-journal-text fs-5"></i><span>Laporan Penjualan</span>
                </a>
            </li>
        </ul>
    </li>
</ul>
