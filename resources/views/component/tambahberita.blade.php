<a href="/kelola-berita" class="btn btn-secondary mb-4">Kembali</a>
<div class="col-12 p-3 bg-white shadow rounded">
    {{-- TODO: Controller not ready yet --}}
    <form class="mt-3" action="/prosestambahberita" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="form-group col-12 col-md-6 mt-3">
                <label for="title">Judul</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="form-group col-12 col-md-6 mt-3">
                <label for="subtitle">Sub Judul</label>
                <input type="text" name="subtitle" id="subtitle" class="form-control">
            </div>
            <div class="form-group col-12 col-md-6 mt-3">
                <label for="image" class="form-label">Gambar Berita</label>
                <input class="form-control @error('image') is invalid @enderror" type="file" id="image"
                    name="image">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $massage }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-12 col-md-6 mt-3">
                <label for="description">Deskripsi</label>
                <textarea name="description" id="description" class="form-control" placeholder="Masukkan description...."
                    style="height: 100px"></textarea>
            </div>

        </div>
        <div class="col-12 col-md-6 mt-5 mb-5">
            <button type="submit" class="btn btn-success">
                Tambahkan Data Berita
            </button>
        </div>
    </form>
</div>
