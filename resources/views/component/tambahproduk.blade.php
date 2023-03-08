    <div class="col-12 p-3 bg-white shadow rounded">
        {{-- TODO: Controller not ready yet --}}
        <form class="mt-3" action="/prosestambahproduk" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-12 col-md-6 mt-3">
                    <label for="nama_produk">Nama Produk</label>
                    <input type="text" name="nama_produk" id="nama_produk" class="form-control">
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
                    <select name="role_pembeli" id="role_pembeli" class="form-control">
                        <option selected>Silahkan Pilih Kategori Pembeli</option>
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
                        <option selected>Silahkan Pilih Kategori Produk</option>
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
                        <option selected>Silahkan Pilih Produk Unggulan</option>
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

            </div>
            <div class="col-12 col-md-6 mt-5 mb-5">
                <button type="submit" class="btn btn-success">
                    Tambahkan Data Produk
                </button>
                <button type="reset" class="btn btn-primary">Reset</button>
            </div>
        </form>
    </div>
