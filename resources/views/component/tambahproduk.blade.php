<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<a href="/produks" class="btn btn-secondary mb-4">Kembali</a>
{{-- TODO: Controller not ready yet --}}
<form class="mb-5" action="/prosestambahproduk" method="post" enctype="multipart/form-data">
    @csrf

    <div class="col-12 mb-3 p-5 bg-white shadow rounded nav-content collapse" id="data-tambahan"
        data-bs-parent="#form-laporan">
        <div class="row">
            <div class="form-group col-12 col-md-6 mt-3">
                <label for="ukuran" class="col-12">Ukuran Produk</label>
                <select class="selectpicker form-control-md col-12" multiple data-live-search="true" name="ukuran[]" id="ukuran">
                    @foreach ($ukuran as $ukurans)
                        <option value="{{ $ukurans->ukuran }}" class="">{{ $ukurans->ukuran }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-12 col-md-6 mt-3">
                <label for="warna" class="col-12">Warna Produk</label>
                <select class="selectpicker form-control-md col-12" multiple data-live-search="true" name="warna[]"
                    id="warna">
                    <option value="Putih">Putih</option>
                    <option value="Hitam">Hitam</option>
                    <option value="Merah">Merah</option>
                    <option value="Biru">Biru</option>
                    <option value="Kuning">Kuning</option>
                    <option value="Hijau">Hijau</option>
                    <option value="orange">Oranye</option>
                    <option value="Ungu">Ungu</option>
                    <option value="pink">Pink</option>
                    <option value="Cokelat">Cokelat</option>
                    <option value="Abu-abu">Abu-abu</option>
                    <option value="Cyan">Cyan</option>
                    <option value="Magenta">Magenta</option>
                    <option value="Perak">Perak</option>
                    <option value="Emas">Emas</option>
                    <option value="Zaitun">Zaitun</option>
                    <option value="Turquoise">Turquoise</option>
                    <option value="Marun">Marun</option>
                    <option value="Navy">Navy</option>
                    <option value="Teal">Teal</option>
                </select>
            </div>
            <div class="form-group col-12 col-md-6 mt-3">
                <label for="angkatan" class="col-12">Angkatan</label>
                <select class="selectpicker form-control-md col-12" multiple data-live-search="true" name="angkatan[]"
                    id="angkatan">
                    @while ($fiveYearsAgoYear <= $currentYear)
                        <option value="{{ $fiveYearsAgoYear }}">{{ $fiveYearsAgoYear }}</option>
                        @php
                            $fiveYearsAgoYear++;
                        @endphp
                    @endwhile
                </select>
            </div>
        </div>
    </div>
    <div class="col-12 p-5bg-white shadow rounded">
        <div class="row">
            <div class="form-group col-12 col-md-6">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" name="nama_produk" id="nama_produk" class="form-control ">
            </div>
            <div class="form-group col-12 col-md-6 mt-3">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control">
            </div>
            <div class="form-group col-12 col-md-6 mt-3">
                <label for="jumlah_produk">Jumlah Produk</label>
                <input type="number" name="jumlah_produk" id="jumlah_produk" class="form-control">
            </div>
            <div class="form-group col-12 col-md-6 mt-3">
                <label for="role_pembeli">Kategori Pembeli</label>
                <select lect name="role_pembeli" id="role_pembeli" class="form-control">
                    <option selected>Silahkan Pilih Kategori Pembeli</option>
                    @foreach ($role as $data)
                        <option value="{{ $data->role }}">{{ $data->role }}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group col-12 col-md-6 mt-3">
                <label for="kategori_produk">Kategori Produk</label>
                <select name="kategori_produk" id="kategori_produk" class="form-control">
                    <option selected>Silahkan Pilih Kategori Produk</option>
                    @foreach ($kategori_produk as $kategori)
                        <option value="{{ $kategori->kategori }}">{{ $kategori->kategori }}</option>
                    @endforeach
                </select>

            </div>

            <div class="form-group col-12 col-md-6 mt-3">
                <label for="produk_unggulan">Produk Unggulan</label>
                <select name="produk_unggulan" id="produk_unggulan" class="form-control">
                    <option selected>Silahkan Pilih Produk Unggulan</option>
                    <option value="Unggulan">Unggulan</option>
                    <option value="Non-Unggulan">Non-Unggulan</option>
                </select>

            </div>
            <div class="form-group col-12 col-md-6 mt-3">
                <label for="gambar_produk" class="form-label">Gambar Produk</label>
                <input class="form-control @error('image') is invalid @enderror" type="file" id="gambar_produk"
                    name="gambar_produk">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $massage }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-12 col-md-6 mt-3">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Masukkan Deskripsi...."
                    style="height: 100px"></textarea>
            </div>
            <div class="form-group col-12 col-md-12 mt-3">
                <div class="card-body d-sm-flex justify-content-between float-right">
                    <h6 class="col col-md-3" name="oke" id="oke">
                        <a href="" class="btn btn-success text-white" data-bs-target="#data-tambahan"
                            data-bs-toggle="collapse">
                            <i class="bi bi-card-text"></i>
                            <span>Data Tambahan</span>
                        </a>
                    </h6>
                </div>
            </div>
            <div class="form-group col-12 col-md-12">
                <div class="card-body d-sm-flex justify-content-between float-right">
                    <small class="bi bi-info-circle fw-bold text-danger fst-italic"> Data Tambahan bersifat optional. Hanya untuk produk yang memiliki spesifikasi angkatan, warna dan ukuran</small>
                </div>
            </div>
        </div>
    </div>
    <div class="row float-right">
        <div class="col-12 col-md-12 mt-5 mb-5">
            <button type="submit" class="btn btn-success">
                Tambahkan Data Produk
            </button>
            <button type="reset" class="btn btn-primary">Reset</button>
        </div>
    </div>
</form>
