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
<div class="card-body d-sm-flex justify-content-sm-between">
    <h6 class="mb-0">
        <a href="/tambahproduk" class="btn btn-success text-white py-2 ml-2">
            <i class="fa fa-plus"></i>
            <span>Tambah Data Produk</span>
        </a>
    </h6>
    <h6 class="col-md-3 mb-0">
        <a href="" class="btn btn-info text-white py-2  " data-bs-target="#components-laporan-bulanan" data-bs-toggle="collapse">
            <i class="fa fa-plus"></i>
            <span>Import data excel</span>
        </a>
    </h6>
</div>

<div class="row justify-content-center">
    <div class="col-8 ">
        <div class="card">
            <form action="{{ route('tambahproduk.import') }}" method="POST" enctype="multipart/form-data" class="p-3">
                @csrf
                <div class="row nav-content collapse justify-content-center align-items-center mt-4" id="components-laporan-bulanan" data-bs-parent="#form-laporan">
                    <div class="col-6 mb-5">
                        <div class="">
                            <label for="formFile" class="form-label">Masukkan Data Pengguna </label>
                            <input class="form-control mt-3" name="file" type="file" id="formFile">
                        </div>
                    </div>
                    <div class="col-2 ">
                        <button type="submit" class="btn btn-primary" name="cari-penjualan" id="cari-penjualan">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
                    <table class="table table-striped table-bordered text-center" id="list">
                        <thead>
                            <tr>
                                <!-- <th scope="col">Pilihan</th> -->
                                <th scope="col">No</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Harga(Rp)</th>
                                <th scope="col">Jumlah Produk</th>
                                {{-- <th scope="col">Kategori Pembeli</th> --}}
                                {{-- <th scope="col">Kategori Produk</th> --}}
                                <th scope="col">Produk Unggulan</th>
                                <th scope="col">Detail</th>
                                <th scope="col">Aksi</th>
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
                                    {{-- <td>{{ $data->role_pembeli }}</td> --}}
                                    {{-- <td>{{ $data->kategori_produk }}</td> --}}
                                    <td>{{ $data->produk_unggulan }}</td>
                                    {{-- <td>{{ $data->deskripsi }}</td> --}}
                                    <td>
                                        <a type="button" class="bi bi-exclamation-circle btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $data->id_produk }}"></a>
                                    </td>
                                    <td>
                                        <a href="/ubahproduk/{{ $data->id_produk }}" title="Ubah Data"
                                            class="bi bi-pencil-square btn btn-warning " style="font-size: 8px"></a>
                                        <a title="Non-Aktifkan Data" class="bi bi-slash-circle-fill btn btn-danger" style="font-size: 8px" data-bs-toggle="modal" data-bs-target="#exampleModal2{{ $data->id_produk }}" ></a>
                                    </td>
                                    <!-- Modal menonaktifkan produk-->
                                    <div class="modal fade" id="exampleModal2{{ $data->id_produk }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body text-center">
                                                Anda yakin akan Non-Aktifkan data ini.. ?
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    <a type="button" class="btn btn-danger" href="/prosesubahstatusproduk/nonaktif/{{ $data->id_produk }}">Non Aktifkan</a>
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $data->id_produk }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Produk</h1>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $data->nama_produk}}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <img src="/product-images/{{ $data->gambar_produk }}" alt="Product Image" width="150" class="">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Harga</label>
                                                    <input type="text" id="disabledTextInput" class="form-control"
                                                        placeholder="Rp. <?php $angka = $data->harga;
                                                                echo number_format($angka, 0, ',', '.');
                                                                ?>" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Kategori</label>
                                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $data->kategori_produk}}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Kategori</label>
                                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $data->role_pembeli}}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Jumlah Produk</label>
                                                    <input type="text" id="disabledTextInput" class="form-control"
                                                        placeholder="<?php $angka = $data->jumlah_produk;
                                                                echo number_format($angka, 0, ',', '.');
                                                                ?>" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Warna</label>
                                                    @if ($data->warna != null)
                                                        <input type="text" class="form-control" id="exampleFormControlTextarea1" rows="3" disabled value="{{ $data->warna}}">
                                                    @else
                                                        <input type="text" class="form-control" id="exampleFormControlTextarea1" rows="3" disabled value="-">
                                                    @endif
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Ukuran</label>
                                                    @if ($data->ukuran_produk != null)
                                                        <input type="text" class="form-control" id="exampleFormControlTextarea1" rows="3" disabled value="{{ $data->ukuran_produk}}">
                                                    @else
                                                        <input type="text" class="form-control" id="exampleFormControlTextarea1" rows="3" disabled value="-">
                                                    @endif
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Angkatan</label>
                                                    @if ($data->angkatan != null)
                                                        <input type="text" class="form-control" id="exampleFormControlTextarea1" rows="3" disabled value="{{ $data->angkatan}}">
                                                    @else
                                                        <input type="text" class="form-control" id="exampleFormControlTextarea1" rows="3" disabled value="-">
                                                    @endif
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>{{ $data->deskripsi}}</textarea>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
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

<div class="d-flex justify-content-end n-link" style="text-decoration: none">
    {{-- {{ $produk->links() }} --}}
</div>
</div>
