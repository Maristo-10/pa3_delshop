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
        <a href="/kelola-metode-pembayaran" class="btn btn-secondary mb-4">Kembali</a>
        <div class="row">
            <div class="col-md-6 mt-3 bg-white">
                <div class="col-12 mt-1">
                    <div class="table-responsive-sm table-wrapper-scroll-y my-custom-scrollbar">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped table-bordered" id="list">
                                    <thead>
                                        <tr>
                                            <th scope="col"class="col-md-1">No</th>
                                            <th scope="col" class="col-md-4">Gambar Kategori</th>
                                            <th scope="col" class="col-md-4">Nama Kategori</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($kategoriproduk as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>
                                                    <img src="/category-images/{{ $data->gambar_kategori }}" alt="" style="max-height: 50px">
                                                </td>
                                                <td>{{ $data->kategori }}</td>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <div class="card ml-5">
                    <div class="card-body">
                        <p class="card-title ml-3 fs-5">Ubah Data Kategori Produk</p>
                        @foreach ($kategoriproduk as $data)
                        <!-- Horizontal Form -->
                        <form class="mt-3" action="/prosesubahkategori/{{ $data->kategori }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="kategori" class="col-sm-5 col-form-label">
                                    <h3 class="fs-6">Nama Kategori</h3>
                                </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="kategori" name="kategori"
                                        value="{{ $data->kategori }}">
                                </div>
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <label for="gambar_kategori" class="col-sm-8 col-form-label">
                                    <h3 class="fs-6">Gambar Kategori Produk</h3>
                                </label>
                                <div class="col-sm-12">
                                    <input class="form-control @error('image') is invalid @enderror" type="file"
                                        id="gambar_kategori" name="gambar_kategori">
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $massage }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn-warning">Ubah</button>
                                <button type="reset" class="btn btn-primary">Reset</button>
                            </div>
                        </form>
                        <!-- End Horizontal Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
