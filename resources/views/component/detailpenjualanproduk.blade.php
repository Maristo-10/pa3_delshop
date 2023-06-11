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
<div class="container">
    <div class="row">
        <div class="col-md">
            <div class="search-bar">
                <form class="search-form d-flex align-items-center" method="GET" action="/kelola-pesanan/search">
                    <input type="text" name="sidPes" id="sidPes" placeholder="Cari Berdasarkan ID Pesanan"
                        title="Masukkan ID Pesanan" class="form-control col-4">
                    <button title="Cari Pesanan" class="btn btn-primary"><i class="bi bi-search"></i></button>
                    <a href="/kelola-pesanan" class="btn btn-secondary text-light">Reset</a>
                </form>
            </div>
        </div>
    </div>
</div>





<div class="col-12 shadow-sm rounded mt-3 bg-white p-3">
    <div class="col-12 mt-1">
        <div class="table-responsive-sm table-wrapper-scroll-y my-custom-scrollbar">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered" id="list">
                        <thead class="text-center">
                            <tr>
                                <!-- <th scope="col">Pilihan</th> -->
                                <th scope="col" class="fw-bold">No</th>
                                <th scope="col" class="fw-bold">Nama Produk</th>
                                <th scope="col" class="fw-bold">Januari</th>
                                <th scope="col" class="fw-bold">Februari</th>
                                <th scope="col" class="fw-bold">Maret</th>
                                {{-- <th scope="col" class="col-md-2">Bukti Pembayaran</th> --}}
                                <th scope="col" class="fw-bold">April</th>
                                <th scope="col" class="fw-bold">Mei</th>
                                <th scope="col" class="fw-bold">Juni</th>
                                <th scope="col" class="fw-bold">Juli</th>
                                <th scope="col" class="fw-bold">Agustus</th>
                                <th scope="col" class="fw-bold">September</th>
                                <th scope="col" class="fw-bold">Oktober</th>
                                <th scope="col" class="fw-bold">November</th>
                                <th scope="col" class="fw-bold">Desember</th>
                                <th scope="col" class="fw-bold">Aksi</th>
                                <!-- <th scope="col">Lampiran</th> -->
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($produk as $index => $data)
                                <tr>
                                    <td>{{ $index + $produk->firstItem() }}</td>
                                    <td class="col-4">{{ $data->nama_produk }}</td>
                                    <td class="col-1">{{ $data->januari }}</td>
                                    <td class="col-1">{{ $data->februari }}</td>
                                    <td class="col-1">{{ $data->maret }}</td>
                                    <td class="col-1">{{ $data->april }}</td>
                                    <td class="col-1">{{ $data->mei }}</td>
                                    <td class="col-1">{{ $data->juni }}</td>
                                    <td class="col-1">{{ $data->juli }}</td>
                                    <td class="col-1">{{ $data->agustus }}</td>
                                    <td class="col-1">{{ $data->september }}</td>
                                    <td class="col-1">{{ $data->oktober }}</td>
                                    <td class="col-1">{{ $data->november }}</td>
                                    <td class="col-1">{{ $data->desember }}</td>
                                    <td>
                                        <a type="button" class="bi bi-exclamation-circle btn btn-info"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal{{ $data->id_produk }}"></a>
                                    </td>
                                    <div class="modal fade" id="exampleModal{{ $data->id_produk }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Produk
                                                    </h1>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1" class="form-label">Nama
                                                            Produk</label>
                                                        <input type="text" id="disabledTextInput"
                                                            class="form-control"
                                                            placeholder="{{ $data->nama_produk }}" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img src="/product-images/{{ $data->gambar_produk }}"
                                                            alt="Product Image" width="150" class="">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1"
                                                            class="form-label">Harga</label>
                                                        <input type="text" id="disabledTextInput"
                                                            class="form-control" placeholder="Rp. <?php $angka = $data->harga;
                                                            echo number_format($angka, 0, ',', '.');
                                                            ?>"
                                                            disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1"
                                                            class="form-label">Kategori</label>
                                                        <input type="text" id="disabledTextInput"
                                                            class="form-control"
                                                            placeholder="{{ $data->kategori_produk }}" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1"
                                                            class="form-label">Kategori</label>
                                                        <input type="text" id="disabledTextInput"
                                                            class="form-control"
                                                            placeholder="{{ $data->role_pembeli }}" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1"
                                                            class="form-label">Jumlah Produk</label>
                                                        <input type="text" id="disabledTextInput"
                                                            class="form-control" placeholder="<?php $angka = $data->jumlah_produk;
                                                            echo number_format($angka, 0, ',', '.');
                                                            ?>"
                                                            disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlTextarea1"
                                                            class="form-label">Warna</label>
                                                        @if ($data->warna != null)
                                                            <input type="text" class="form-control"
                                                                id="exampleFormControlTextarea1" rows="3"
                                                                disabled value="{{ $data->warna }}">
                                                        @else
                                                            <input type="text" class="form-control"
                                                                id="exampleFormControlTextarea1" rows="3"
                                                                disabled value="-">
                                                        @endif
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlTextarea1"
                                                            class="form-label">Ukuran</label>
                                                        @if ($data->ukuran_produk != null)
                                                            <input type="text" class="form-control"
                                                                id="exampleFormControlTextarea1" rows="3"
                                                                disabled value="{{ $data->ukuran_produk }}">
                                                        @else
                                                            <input type="text" class="form-control"
                                                                id="exampleFormControlTextarea1" rows="3"
                                                                disabled value="-">
                                                        @endif
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlTextarea1"
                                                            class="form-label">Angkatan</label>
                                                        @if ($data->angkatan != null)
                                                            <input type="text" class="form-control"
                                                                id="exampleFormControlTextarea1" rows="3"
                                                                disabled value="{{ $data->angkatan }}">
                                                        @else
                                                            <input type="text" class="form-control"
                                                                id="exampleFormControlTextarea1" rows="3"
                                                                disabled value="-">
                                                        @endif
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlTextarea1"
                                                            class="form-label">Deskripsi</label>
                                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>{{ $data->deskripsi }}</textarea>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-dismiss="modal">Close</button>
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

<script type="text/javascript">
    function eventStatus() {
        $('#f-status').prop('disabled', false);
    }
</script>
