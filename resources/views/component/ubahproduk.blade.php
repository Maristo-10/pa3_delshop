    <!-- Bootstrap CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <a href="/produks" class="btn btn-secondary mb-4">Kembali</a>
    <div class="col-12 p-3 bg-white shadow rounded">
        {{-- TODO: Controller not ready yet --}}
        <form class="mt-3" action="/prosesubahproduk/{{ $produk->id_produk }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <h1>Ubah Produk</h1>
            <div class="row">
                <div class="form-group col-12 col-md-6 mt-3">
                    <label for="nama_produk">Nama Produk</label>
                    <input type="text" name="nama_produk" id="nama_produk" class="form-control"
                        value="{{ $produk->nama_produk }}">
                </div>
                <div class="form-group col-12 col-md-6 mt-3">
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control"
                        value="{{ $produk->harga }}">
                </div>
                <div class="form-group col-12 col-md-6 mt-3">
                    <label for="jumlah_produk">Jumlah Produk</label>
                    <input type="number" name="jumlah_produk" id="jumlah_produk" class="form-control"
                        value="{{ $produk->jumlah_produk }}">
                </div>
                <div class="form-group col-12 col-md-6 mt-3">
                    <label for="ukuran" class="col-12">Ukuran Produk</label>
                    <select class="selectpicker form-control-md col-12" multiple data-live-search="true" name="ukuran[]"
                        id="ukuran">
                        <option selected>{{ $produk->ukuran_produk }}</option>
                        @foreach ($ukuran as $ukurans)
                            <option value="{{ $ukurans->ukuran }}" class="">{{ $ukurans->ukuran }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-12 col-md-6 mt-3">
                    <label for="warna" class="col-12">Warna Produk</label>
                    <select class="selectpicker form-control-md col-12" multiple data-live-search="true" name="warna[]"
                        id="warna">
                        <option selected>{{ $produk->warna }}</option>
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
                    <select class="selectpicker form-control-md col-12" multiple data-live-search="true"
                        name="angkatan[]" id="angkatan">
                        <option selected>{{ $produk->angkatan }}</option>
                        @while ($fiveYearsAgoYear <= $currentYear)
                            <option value="{{ $fiveYearsAgoYear }}">{{ $fiveYearsAgoYear }}</option>
                            @php
                                $fiveYearsAgoYear++;
                            @endphp
                        @endwhile
                    </select>
                </div>
                <div class="form-group col-12 col-md-6 mt-3">
                    <label for="role_pembeli">Kategori Pembeli</label>
                    <select name="role_pembeli" id="role_pembeli" class="form-control">
                        <option selected>{{ $produk->role_pembeli }}</option>
                        @foreach ($role as $data)
                            <option value="{{ $data->role }}">{{ $data->role }}</option>
                        @endforeach
                    </select>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#role_pembeli').select2();
                        });
                    </script>
                </div>
                <div class="form-group col-12 col-md-6 mt-3">
                    <label for="kategori_produk">Kategori Produk</label>
                    <select name="kategori_produk" id="kategori_produk" class="form-control">
                        <option selected>{{ $produk->kategori_produk }}</option>
                        @foreach ($kategori_produk as $kategori)
                            <option value="{{ $kategori->kategori }}">{{ $kategori->kategori }}</option>
                        @endforeach
                    </select>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#kategori_produk').select2();
                        });
                    </script>
                </div>
                <div class="form-group col-12 col-md-6 mt-3">
                    <label for="produk_unggulan">Produk Unggulan</label>
                    <select name="produk_unggulan" id="produk_unggulan" class="form-control">
                        <option selected>{{ $produk->produk_unggulan }}</option>
                        <option value="Unggulan">Unggulan</option>
                        <option value="Non-Unggulan">Non-Unggulan</option>
                    </select>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#produk_unggulan').select2();
                        });
                    </script>
                </div>
                <div class="form-group col-12 col-md-6 mt-3">
                    <label for="gambar_produk" class="form-label">Gambar Produk</label>
                    <input class="form-control @error('image') is invalid @enderror" type="file" id="gambar_produk"
                        name="gambar_produk" value="{{ '/product-images/' . $produk->gambar_produk }}">
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $massage }}
                        </div>
                    @enderror

                </div>
                <div class="form-group col-12 col-md-6 mt-3">
                    <label for="modal">Harga Beli</label>
                    <input type="number" name="modal" id="modal" class="form-control"
                        value="{{ $produk->modal }}">
                </div>
                <div class="form-group col-12 col-md-6 mt-3">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" style="height: 100px">{{ $produk->deskripsi }}</textarea>
                </div>
            </div>
            <div class="col-12 col-md-6 mt-5 mb-5">
                <button type="submit" class="btn btn-warning">
                    Ubah Data Produk
                </button>
                <button type="reset" class="btn btn-primary">Reset</button>
            </div>
        </form>
    </div>
