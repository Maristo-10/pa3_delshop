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
    
    
    <a href="/kelola-berita" class="btn btn-warning mb-4">Kembali</a>
    <div class="col-12 p-3 bg-white shadow rounded">
        {{-- TODO: Controller not ready yet --}}
        <form class="mt-3" action="/prosesubahberita/{{ $berita->id }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-12 col-md-6 mt-3">
                    <label for="title">Judul</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $berita->title}}">
                </div>
                <div class="form-group col-12 col-md-6 mt-3">
                    <label for="subtitle">Sub Judul</label>
                    <input type="text" name="subtitle" id="subtitle" class="form-control" value="{{ $berita->subtitle}}">
                </div>
                <div class="form-group col-12 col-md-6 mt-3">
                    <label for="image" class="form-label">Gambar Berita</label>
                    <input class="form-control @error('image') is invalid @enderror" type="file" id="image" name="image">
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $massage }}
                        </div>
                    @enderror
                    <img src="/berita-images/{{ $berita->image }}" alt="">
                </div>
                <div class="form-group col-12 col-md-6 mt-3">
                    <label for="description">Deskripsi</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Masukkan description....">
                        {{ $berita->description}}
                    </textarea>
                </div>
            </div>
            </div>
            <div class="col-12 col-md-6 mt-5 mb-5">
                <button type="submit" class="btn btn-warning">
                    Ubah Data Berita
                </button>
                <button type="reset" class="btn btn-primary">Reset</button>
            </div>
        </form>
    </div>
