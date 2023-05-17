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
    <h6 class="col-md-7 mb-0">
        <a href="/tambahproduk" class="btn btn-success text-white py-2 ml-2">
            <i class="fa fa-plus"></i>
            <span>Tambah Data Produk</span>
        </a>
    </h6>
    <h6 class="col-md-5 mb-0">
        <a href="tambahproduk/import" class="btn btn-success text-white py-2 ml-2">
            <i class="fa fa-plus"></i>
            <span>Import Data Excel</span>
        </a>
    </h6>
</div>
<div class="col-12 shadow-sm rounded mt-3 bg-white p-3">
    <div class="col-12 mt-1">
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
                                <th scope="col" class="col-md-1">Nama Produk</th>
                                <th scope="col" class="col-md-1">Harga(Rp)</th>
                                <th scope="col" class="col-md-1">Jumlah Produk</th>
                                <th scope="col" class="col-md-1">Kategori Pembeli</th>
                                <th scope="col" class="col-md-1">Kategori Produk</th>
                                <th scope="col" class="col-md-1">Produk Unggulan</th>
                                <th scope="col" class="col-md-1">Status Produk</th>
                                <th scope="col" class="col-md-3">Keterangan</th>
                                <th scope="col" class="col-md-3">Aksi</th>
                                <!-- <th scope="col">Lampiran</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($produk as $index => $data)
                                <tr>
                                    <td>{{ $index + $produk->firstItem() }}</td>
                                    <td>{{ $data->nama_produk }}</td>
                                    <td style="text-align:right"><?php
                                        $angka =$data->harga;
                                            echo  number_format( $angka , 0, ",", ".");
                                        ?></td>
                                    <td style="text-align:right"><?php
                                        $angka =$data->jumlah_produk;
                                            echo  number_format( $angka , 0, ",", ".");
                                        ?></td>
                                    <td>{{ $data->role_pembeli }}</td>
                                    <td>{{ $data->kategori_produk }}</td>
                                    <td>{{ $data->produk_unggulan }}</td>
                                    <td>{{ $data->status_produk }}</td>
                                    <td>{{ $data->deskripsi }}</td>
                                    <td>
                                        <a href="/ubahproduk/{{ $data->id_produk }}" title="Ubah Data"
                                            class="bi bi-pencil-square btn btn-warning " style="font-size: 8px"></a>
                                        <a title="Non-Aktifkan Data" href="/prosesubahstatusproduk/nonaktif/{{ $data->id_produk }}" class="bi bi-slash-circle-fill btn btn-danger" style="font-size: 8px" ></a>
                                    </td>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body text-center">
                                                Anda yakin akan menghapus data ini.. ?
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    <a type="button" class="btn btn-danger" href="/prosesubahstatusproduk/nonaktif/{{ $data->id_produk }}">Hapus</a>
                                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                        </tbody>

                    </table>
                        {{ $produk->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
