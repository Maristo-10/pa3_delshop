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
<div class="col-12 shadow-sm rounded mt-3 bg-white p-3">
    <div class="col-12 mt-1">
        <div class="table-responsive-sm table-wrapper-scroll-y my-custom-scrollbar">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="list">
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
                                <th scope="col">Keterangan</th>
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
                                        <a type="button" class="bi bi-exclamation-circle btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal"></a>
                                    </td>
                                    <td>
                                        <a href="/ubahproduk/{{ $data->id_produk }}" title="Ubah Data"
                                            class="bi bi-pencil-square btn btn-warning " style="font-size: 8px"></a>
                                        <a title="Non-Aktifkan Data" class="bi bi-slash-circle-fill btn btn-danger" style="font-size: 8px" data-bs-toggle="modal" data-bs-target="#exampleModal2" ></a>
                                    </td>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Data Pesanan</h1>
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
                                                    <label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $data->deskripsi }}" disabled>
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
</div>
