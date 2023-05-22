<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Page Header Start -->
<div class="container-fluid ">
    <div class="row px-xl-5 mt-3">
        <div class="col-lg">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class=" col 12 card-body d-sm-flex justify-content-between text-center">
    <h6 class="col-md-12 mb-0">
        <button class="btn btn-success text-white py-2 ml-2" name="btn-ditangguhkan" id="btn-ditangguhkan">
            <span>Belum Dibayar</span>
        </button>
        <button class="btn btn-success text-white py-2 ml-2" name="btn-diproses" id="btn-diproses">
            <span>Sedang Diproses</span>
        </button>
        <button class="btn btn-success text-white py-2 ml-2" name="btn-belum" id="btn-belum">
            <span>Belum Diambil</span>
        </button>
        <button class="btn btn-success text-white py-2 ml-2" name="btn-selesai" id="btn-selesai">
            <span>Selesai</span>
        </button>
    </h6>
</div>
<div class="col-md-12 mt-3 text-center">
    <h3>Riwayat Pesanan</h3>
</div>
<!-- Page Header End -->
<div class="col-12 shadow-sm rounded mt-3 bg-white p-3">
    <div class="col-12 mt-1" style="justify-content:center;align-items:center;display:flex">
        <div class="table-responsive-sm table-wrapper-scroll-y my-custom-scrollbar col-md-11 text-center">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="list">
                        <thead>
                            <tr>
                                <!-- <th scope="col">Pilihan</th> -->
                                <th scope="col" class="">No</th>
                                <th scope="col" class="col-md-2">Tanggal Pesanan</th>
                                <th scope="col" class="col-md-2">Total Harga</th>
                                <th scope="col" class="col-md-2">Nama Pengambil</th>
                                <th scope="col" class="col-md-1">Metode Pembayaran</th>
                                <th scope="col" class="col-md-1">Nama Layanan</th>
                                <th scope="col" class="col-md-1">Bukti Pembayaran</th>
                                <th scope="col" class="col-md-1">Status</th>
                                <th scope="col" class="col-md-2">Aksi</th>
                                <!-- <th scope="col">Lampiran</th> -->
                            </tr>
                        </thead>
                        <tbody id="table-pesanan" name="table-pesanan">
                            @php
                                $no = 1;
                            @endphp

                            @foreach ($pesanan_kapem as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->tanggal }}</td>
                                    <td>Rp. <?php
                                    $angka = $data->total_harga;
                                    echo number_format($angka, 0, ',', '.');
                                    ?></td>
                                    <td>{{ $data->nama_pengambil }}</td>
                                    <td>{{ $data->kapem }}</td>
                                    <td>{{ $data->nama_layanan }}</td>
                                    <td>
                                        <img src="/pembayaran-images/{{ $data->bukti_pembayaran }}" alt=""
                                            style="max-height: 50px">
                                    </td>
                                    <td><b>{{ $data->status }}</b></td>
                                    <td>
                                        <a href="/detail-pesanan/{{ $data->id }}" title="Lihat Detail Pesanan"
                                            class="bi bi-eye btn btn-secondary" style="font-size: 15px"></a>
                                        <a href="/prosesubahstatusproduk/nonaktif/" title="Batalkan Pesanan"
                                            class="bi bi-x-lg btn btn-danger ml-2" style="font-size: 15px"></a>
                                    </td>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <div class="row">
                            <div class="col-md-12">
                                {{ $pesanan_kapem->links('pagination::tailwind') }}
                            </div>
                        </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#btn-ditangguhkan').on('click', function() {
            $('#table-pesanan').html('');
            $.ajax({
                url: '{{ route('getDitangguhkan') }}',
                type: 'get',
                success: function(res) {
                    $('#table-pesanan').html(' ');
                    $no = 1;
                    $.each(res, function(key, value) {
                        $('#table-pesanan').append('<tr>');
                        $('#table-pesanan').append('<td>' + $no++ + '</td>');
                        $('#table-pesanan').append('<td>' + value.tanggal +
                            '</td>');
                        var number_string = value.total_harga.toString(),
                            sisa = number_string.length % 3,
                            rupiah = number_string.substr(0, sisa),
                            ribuan = number_string.substr(sisa).match(/\d{3}/g);

                        if (ribuan) {
                            separator = sisa ? '.' : '';
                            rupiah += separator + ribuan.join('.');
                        }
                        $('#table-pesanan').append('<td>' + 'Rp. ' + rupiah +
                            '</td>');
                        $('#table-pesanan').append(
                            '<td>' + value.nama_pengambil + '</td>');
                        $('#table-pesanan').append(
                            '<td>' + value.kategori_pembayaran + '</td>');
                        $('#table-pesanan').append(
                            '<td>' + value.nama_layanan + '</td>');
                        $('#table-pesanan').append(
                            "<td><small>Kosong</small></td>");
                        $('#table-pesanan').append(
                            '<td>' + value.status + '</td>');
                        $('#table-pesanan').append(
                            "<td><a href='/detail-pesanan/" + value.id + "' title='Lihat Detail Pesanan' class='bi bi-eye btn btn-secondary' style='font-size: 15px'></a> <a href='#' title='Batalkan Pesanan' class='bi bi-x-lg btn btn-danger ml-2' style='font-size: 15px'></a></td>"
                        );
                        $('#table-pesanan').append('</tr>');
                    });
                }
            });
        });

        $('#btn-diproses').on('click', function() {
            $('#table-pesanan').html('');
            $.ajax({
                url: '{{ route('getDiproses') }}',
                type: 'get',
                success: function(res) {
                    $('#table-pesanan').html(' ');
                    $no = 1;
                    $.each(res, function(key, value) {
                        $('#table-pesanan').append('<tr>');
                        $('#table-pesanan').append('<td>' + $no++ + '</td>');
                        $('#table-pesanan').append('<td>' + value.tanggal +
                            '</td>');
                        var number_string = value.total_harga.toString(),
                            sisa = number_string.length % 3,
                            rupiah = number_string.substr(0, sisa),
                            ribuan = number_string.substr(sisa).match(/\d{3}/g);

                        if (ribuan) {
                            separator = sisa ? '.' : '';
                            rupiah += separator + ribuan.join('.');
                        }
                        $('#table-pesanan').append('<td>' + 'Rp. ' + rupiah +
                            '</td>');
                        $('#table-pesanan').append(
                            '<td>' + value.nama_pengambil + '</td>');
                        $('#table-pesanan').append(
                            '<td>' + value.kategori_pembayaran + '</td>');
                        $('#table-pesanan').append(
                            '<td>' + value.nama_layanan + '</td>');
                        $('#table-pesanan').append(
                            "<td><img src='/pembayaran-images/" + value
                            .bukti_pembayaran +
                            "'style='max-height: 50px'></td>");
                        $('#table-pesanan').append(
                            '<td>' + value.status + '</td>');
                        $('#table-pesanan').append(
                            "<td><a href='/detail-pesanan/" + value.id +
                            "' title='Lihat Detail Pesanan' class='bi bi-eye btn btn-secondary' style='font-size: 15px'></a><a href='/prosesubahstatusproduk/nonaktif/' title='Batalkan Pesanan' class='bi bi-x-lg btn btn-danger ml-2' style='font-size: 15px'></a></td>"
                        );
                        $('#table-pesanan').append('</tr>');
                    });
                }
            });
        });
        $('#btn-belum').on('click', function() {
            $('#table-pesanan').html('');
            $.ajax({
                url: '{{ route('getBelum') }}',
                type: 'get',
                success: function(res) {
                    $('#table-pesanan').html(' ');
                    $no = 1;
                    $.each(res, function(key, value) {
                        $('#table-pesanan').append('<tr>');
                        $('#table-pesanan').append('<td>' + $no++ + '</td>');
                        $('#table-pesanan').append('<td>' + value.tanggal +
                            '</td>');
                        var number_string = value.total_harga.toString(),
                            sisa = number_string.length % 3,
                            rupiah = number_string.substr(0, sisa),
                            ribuan = number_string.substr(sisa).match(/\d{3}/g);

                        if (ribuan) {
                            separator = sisa ? '.' : '';
                            rupiah += separator + ribuan.join('.');
                        }
                        $('#table-pesanan').append('<td>' + 'Rp. ' + rupiah +
                            '</td>');
                        $('#table-pesanan').append(
                            '<td>' + value.nama_pengambil + '</td>');
                        $('#table-pesanan').append(
                            '<td>' + value.kategori_pembayaran + '</td>');
                        $('#table-pesanan').append(
                            '<td>' + value.nama_layanan + '</td>');
                        $('#table-pesanan').append(
                            "<td><img src='/pembayaran-images/" + value
                            .bukti_pembayaran +
                            "'style='max-height: 50px'></td>");
                        $('#table-pesanan').append(
                            '<td>' + value.status + '</td>');
                        $('#table-pesanan').append(
                            "<td><a href='/detail-pesanan/" + value.id +
                            "' title='Lihat Detail Pesanan' class='bi bi-eye btn btn-secondary' style='font-size: 15px'></a><a href='/prosesubahstatusproduk/nonaktif/' title='Batalkan Pesanan' class='bi bi-x-lg btn btn-danger ml-2' style='font-size: 15px'></a></td>"
                        );
                        $('#table-pesanan').append('</tr>');
                    });
                }
            });
        });
        $('#btn-selesai').on('click', function() {
            $('#table-pesanan').html('');
            $.ajax({
                url: '{{ route('getSelesai') }}',
                type: 'get',
                success: function(res) {
                    $('#table-pesanan').html(' ');
                    $no = 1;
                    $.each(res, function(key, value) {
                        $('#table-pesanan').append('<tr>');
                        $('#table-pesanan').append('<td>' + $no++ + '</td>');
                        $('#table-pesanan').append('<td>' + value.tanggal +
                            '</td>');
                        var number_string = value.total_harga.toString(),
                            sisa = number_string.length % 3,
                            rupiah = number_string.substr(0, sisa),
                            ribuan = number_string.substr(sisa).match(/\d{3}/g);

                        if (ribuan) {
                            separator = sisa ? '.' : '';
                            rupiah += separator + ribuan.join('.');
                        }
                        $('#table-pesanan').append('<td>' + 'Rp. ' + rupiah +
                            '</td>');
                        $('#table-pesanan').append(
                            '<td>' + value.nama_pengambil + '</td>');
                        $('#table-pesanan').append(
                            '<td>' + value.kategori_pembayaran + '</td>');
                        $('#table-pesanan').append(
                            '<td>' + value.nama_layanan + '</td>');
                        $('#table-pesanan').append(
                            "<td><img src='/pembayaran-images/" + value
                            .bukti_pembayaran +
                            "'style='max-height: 50px'></td>");
                        $('#table-pesanan').append(
                            '<td>' + value.status + '</td>');
                        $('#table-pesanan').append(
                            "<td><a href='/detail-pesanan/" + value.id +
                            "' title='Lihat Detail Pesanan' class='bi bi-eye btn btn-secondary' style='font-size: 15px'></a><a href='/prosesubahstatusproduk/nonaktif/' title='Batalkan Pesanan' class='bi bi-x-lg btn btn-danger ml-2' style='font-size: 15px'></a></td>"
                        );
                        $('#table-pesanan').append('</tr>');
                    });
                }
            });
        });
    });
</script>
