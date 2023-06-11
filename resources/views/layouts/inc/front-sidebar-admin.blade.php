<div id="mySidenav" class="sidenav text-primary">
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

