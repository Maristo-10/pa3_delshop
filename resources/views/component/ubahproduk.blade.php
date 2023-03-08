    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/sidebar.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('/css/argon-dashboard.css?v=1.1.2') }}" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <title>Ubah Produk</title>


    <div class="col-12 p-3 bg-white shadow rounded">
        {{-- TODO: Controller not ready yet --}}
        <form class="mt-3" action="/prosesubahproduk/{{ $produk->id_produk }}" method="post"
            enctype="multipart/form-data">
            @csrf
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
                    <input class="form-control @error('image') is invalid @enderror" type="file" id="gambar_produk" name="gambar_produk" value="{{'/product-images/'.$produk->gambar_produk}}">
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $massage}}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-12 col-md-6 mt-3">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control"  style="height: 100px">{{ $produk->deskripsi }}</textarea>
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
