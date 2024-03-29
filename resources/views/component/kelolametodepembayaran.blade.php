<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

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

<div class="row">
    <div class="col col-md-7">
        <small>
            <a href="/tambah-metode-pembayaran" class="btn btn-success text-white py-2 ml-2 mb-3">
                <i class="fa fa-plus"></i>
                <span><small>Tambah Data Metode Pembayaran</small></span>
            </a>
        </small>
        <div class="">
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
                                    <th scope="col">No</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Nama Layanan</th>
                                    <th scope="col">Nomor Pembayaran</th>
                                    <th scope="col">Nama Pemilik</th>
                                    <th scope="col">Kategori Layanan</th>
                                    <th scope="col">Aksi</th>
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
                                        <td>{{ $data->status_metpem }}</td>
                                        <td>{{ $data->layanan }}</td>
                                        <td>{{ $data->no_layanan }}</td>
                                        <td>{{ $data->nama_pemilik }}</td>
                                        <td>{{ $data->kapem }}</td>
                                        <td style="text-align: center">
                                            <a href="/ubah-metode-pembayaran/{{ $data->id_metpem }}" title="Ubah Data"
                                                class="bi bi-pencil-square btn btn-warning" style="font-size: 10px"></a>
                                            @if ($data->status_metpem == 'Aktif')
                                                <a title="Non-Aktifkan Data"
                                                        class="bi bi-slash-circle-fill btn btn-danger"
                                                        style="font-size: 10px" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal2{{ $data->id_metpem }}"></a>
                                                @else
                                                    <a title="Aktifkan Data" class="bi bi-slash-circle-fill btn btn-success"
                                                        style="font-size: 10px" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal3{{ $data->id_metpem }}"></a>
                                                @endif
                                            {{-- <a title="Non-Aktifkan Data" class="bi bi-slash-circle-fill btn btn-danger" style="font-size: 8px" data-bs-toggle="modal" data-bs-target="#exampleModal2" ></a> --}}

                                            {{-- <a href="/prosesubahstatusmetpem/non-aktif/{{ $data->id_metpem}}" title="Non-Aktifkan Data"
                                                class="bi bi-slash-circle-fill btn btn-danger"></a> --}}
                                        </td>
                                        <!-- Modal menon-aktifkan-->
                                        <div class="modal fade" id="exampleModal2{{ $data->id_metpem }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body text-center">
                                                        Anda yakin akan Non-Aktifkan data ini.. ?
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <a type="button" class="btn btn-danger"
                                                            href="/prosesubahstatusmetpem/non-aktif/{{ $data->id_metpem }}">Non
                                                            Aktifkan</a>
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal mengaktifkan -->
                                        <div class="modal fade" id="exampleModal3{{ $data->id_metpem }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body text-center">
                                                        Anda yakin akan Aktifkan data ini.. ?
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <a type="button" class="btn btn-success"
                                                            href="/prosesubahstatusmetpem/aktif/{{ $data->id_metpem }}">Aktifkan</a>
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $metpem->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="col col-md-5 shadow-sm rounded bg-white">
            <button class="btn btn-success text-white mb-3" onclick="eventBtnt();">
                <i class="fa fa-plus"></i>
                <span><small>Tambah Kategori Pembayaran</small></span>
            </button>
            <div class="card" id="tambah_kapem" name="tambah_kapem" hidden>
                <div class="row p-3">
                    <div class="btn-close-form">
                        <button class="btn btn-danger bi bi-x-lg float-right ml-1" style="font-size: 10px"
                            onclick="eventCloset()"></button>
                    </div>
                    <div class="card-body">
                        <small class="card-title ml-3">Tambah Data Kategori Produk</small>

                        <!-- Horizontal Form -->

                        <form class="" action="/prosestambahkategoripembayaran"
                            method="post"enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="kategori_pembayaran" class="col-sm-12 col-form-label">
                                    <small>Kategori Pembayaran</small>
                                </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="kategori_pembayaran"
                                        name="kategori_pembayaran">
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
                    @if ($message = Session::get('success2'))
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
                                <th scope="col">No</th>
                                <th scope="col">Kategori Pembayaran</th>
                                <th scope="col">Aksi</th>
                                <!-- <th scope="col">Lampiran</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($kapem as $index => $data)
                                <tr>
                                    <td>{{ $index + $kapem->firstItem() }}</td>
                                    <td>{{ $data->kategori_pembayaran }}</td>
                                    <td>
                                        <a class="bi bi-pencil-square btn btn-warning "
                                            href="/ubah-kategori-pembayaran/{{ $data->id_kapem }}"
                                            title="Ubah Data"></a>
                                            @if ($data->id_kapem != 901)
                                            <a type="button" title="Hapus Data"
                                            class="bi bi-trash-fill btn btn-danger ml-2" style="font-size: 15px"
                                            data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $data->id_kapem }}"></a>
                                            @else
                                            <button type="button" title="Hapus Data"
                                            class="bi bi-trash-fill btn btn-danger ml-2" style="font-size: 15px"
                                            data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $data->id_kapem }}" disabled></button>
                                            @endif

                                    </td>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $data->id_kapem   }}"
                                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakun untuk menghapus data ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="/hapus/kategoripembayaran/{{ $data->kategori_pembayaran }}"
                                                        class="btn btn-danger">Ya</a>
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $kapem->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
