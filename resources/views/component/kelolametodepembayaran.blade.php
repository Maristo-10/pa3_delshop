<link href="{{ asset('/css/argon-dashboard.css?v=1.1.2') }}" rel="stylesheet" />
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.js">
</script>

<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<div class="card-body d-sm-flex justify-content-between">
    <h6 class="col-md-12 mb-0">
    </h6>
</div>

<script type="text/javascript">
    function eventBtnt() {
        $('#tambah_kapem').prop('hidden', false);
    }

    function eventCloset() {
        $('#tambah_kapem').prop('hidden', true);
    }
</script>

<div class="row col-12">
    <div class="col-7 ">
        <small><a href="/tambah-metode-pembayaran" class="btn btn-success text-white py-2 ml-2 mb-3">
            <i class="fa fa-plus"></i>
            <span><small>Tambah Data Metode Pembayaran</small></span>
        </a></small>
        <div class="col-12">
            <div class="table-responsive-sm table-wrapper-scroll-y my-custom-scrollbar">
                <div class="card">
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif

                        @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        <table class="table table-striped table-bordered" id="list">
                            <thead>
                                <tr>
                                    <!-- <th scope="col">Pilihan</th> -->
                                    <th scope="col" class="col-md-1">No</th>
                                    <th scope="col" class="col-md-2">Nama Layanan</th>
                                    <th scope="col" class="col-md-2">Nomor Pembayaran</th>
                                    <th scope="col" class="col-md-2">Nama Pemilik</th>
                                    <th scope="col" class="col-md-2">Kategori Layanan</th>
                                    <th scope="col" class="col-md-2">Aksi</th>
                                    <!-- <th scope="col">Lampiran</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($metpem as $index => $data)
                                    <tr>
                                        <td>{{ $index + $metpem->firstItem() }}</td>
                                        <td>{{ $data->nama_layanan }}</td>
                                        <td>{{ $data->no_layanan }}</td>
                                        <td>{{ $data->nama_pemilik }}</td>
                                        <td>{{ $data->kapem }}</td>
                                        <td style="text-align: center">
                                            <a href="/ubah-metode-pembayaran/{{ $data->id_metpem }}" title="Ubah Data"
                                                class="bi bi-pencil-square btn btn-warning"></a>
                                            <a href="/prosesubahstatusproduk/nonaktif/" title="Non-Aktifkan Data"
                                                class="bi bi-slash-circle-fill btn btn-danger"></a>
                                        </td>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $metpem->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-4 ml-5 shadow-sm rounded bg-white">
        <button class="btn btn-success text-white py-2 ml-2 mb-3" onclick="eventBtnt();">
            <i class="bi bi-eye-fill"></i>
            <span><small>Tambah Kategori Pembayaran</small></span>
        </button>
        <div class="card" id="tambah_kapem" name="tambah_kapem" hidden>
            <div class="row">
                <div class="btn-close-form">
                    <button class="btn btn-danger bi bi-x-lg float-right ml-1" style="font-size: 10px"
                        onclick="eventCloset()"></button>
                </div>
                <div class="card-body">
                    <small class="card-title ml-3">Tambah Data Kategori Produk</small>

                    <!-- Horizontal Form -->

                    <form class="" action="/prosestambahkategoripembayaran" method="post"enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="kategori_pembayaran" class="col-sm-12 col-form-label">
                                <small>Kategori Pembayaran</small>
                            </label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="kategori_pembayaran" name="kategori_pembayaran">
                            </div>
                        </div>
                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-success"><small>Tambah</small> </button>
                            <button type="reset" class="btn btn-primary"><small>Reset</small> </button>
                        </div>
                    </form><!-- End Horizontal Form -->
                </div>
            </div>


        </div>

        <div class="card" id="table_kapem" name="table_kapem">

            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif

                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                <table class="table table-striped table-bordered" id="list">
                    <thead>
                        <tr>
                            <!-- <th scope="col">Pilihan</th> -->
                            <th scope="col" class="col-md-1">No</th>
                            <th scope="col" class="col-md-3">Kategori Pembayaran</th>
                            <th scope="col" class="col-md-3">Aksi</th>
                            <!-- <th scope="col">Lampiran</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($kapem as $index =>$data)
                            <tr>
                                <td>{{ $index + $kapem->firstItem() }}</td>
                                <td>{{ $data->kategori_pembayaran }}</td>
                                <td style="text-align: center">
                                    <a class="bi bi-pencil-square btn btn-warning col-md-4" href="/ubah-kategori-pembayaran/{{$data->kategori_pembayaran}}" title="Ubah Data"></a>
                                    <a href="/hapus/kategoripembayaran/{{$data->kategori_pembayaran}}" title="Hapus Data"
                                        class="bi bi-trash-fill btn btn-danger col-md-4"></a>
                                </td>
                        @endforeach
                    </tbody>
                </table>
                {{ $kapem->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</div>
