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
<div class="col-12 shadow-sm rounded mt-3 bg-white p-3">
    <div class="col-12 mt-1">
        <div class="table-responsive-sm table-wrapper-scroll-y my-custom-scrollbar">
            <div class="card">
                <div class="card-body">
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
                            @foreach ($metpemNonAktif as $index => $data)
                                <tr>
                                    <td>{{ $index + $metpemNonAktif->firstItem() }}</td>
                                    <td>{{ $data->layanan }}</td>
                                    <td>{{ $data->no_layanan }}</td>
                                    <td>{{ $data->nama_pemilik }}</td>
                                    <td>{{ $data->kapem }}</td>
                                    <td style="text-align: center">
                                        <a href="/ubah-metode-pembayaran/{{ $data->id_metpem }}" title="Ubah Data"
                                            class="bi bi-pencil-square btn btn-warning"></a>

                                        <a title="Aktifkan Data" class="bi bi-slash-circle-fill btn btn-danger" style="font-size: 8px" data-bs-toggle="modal" data-bs-target="#exampleModal2" ></a>

                                        {{-- <a href="/prosesubahstatusmetpem/aktif/{{ $data->id_metpem}}" title="Aktifkan Data"
                                            class="bi bi-slash-circle-fill btn btn-danger"></a> --}}
                                    </td>
                                    <!-- Modal mengaktifkan -->
                                    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body text-center">
                                                Anda yakin akan Aktifkan data ini.. ?
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    <a type="button" class="btn btn-danger" href="/prosesubahstatusmetpem/aktif/{{ $data->id_metpem}}">Aktifkan</a>
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                        {{-- {{ $produk->links('pagination::tailwind') }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
