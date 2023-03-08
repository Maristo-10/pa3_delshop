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
            <div class="col-md-6 mt-3 bg-white">
                <div class="col-12 mt-1">
                    <div class="table-responsive-sm table-wrapper-scroll-y my-custom-scrollbar">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped table-bordered" id="list">
                                    <thead>
                                        <tr>
                                            <!-- <th scope="col">Pilihan</th> -->
                                            <th scope="col"class="col-md-2">No</th>
                                            <th scope="col" class="col-md-4">Gambar Kategori</th>
                                            <th scope="col" class="col-md-4">Nama Kategori</th>
                                            <th scope="col"class="col-md-2">Aksi</th>
                                            <!-- <th scope="col">Lampiran</th> -->
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
                                                <td>
                                                    <a href="/ubahkategoriproduk/{{ $data->kategori }}"
                                                        title="Ubah Data"
                                                        class=" bi bi-pencil-square btn btn-warning col-md-4 ml-3 py-2"></a>
                                                    <a href="/hapuskategoriproduk/{{ $data->kategori }}"
                                                        title="Hapus Data"
                                                        class="bi bi-trash-fill btn btn-danger col-md-4 ml-3 py-2 "></a>
                                                </td>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 mt-3">
                <div class="card ml-5">
                    <div class="card-body">
                        <h5 class="card-title ml-3">Ubah Data Kategori Produk</h5>
                        @foreach ($kategoriproduk as $data)
                        <!-- Horizontal Form -->
                        <form class="mt-3" action="/prosesubahkategori/{{ $data->kategori }}" method="post"enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="kategori" class="col-sm-5 col-form-label">
                                    <h4>Nama Kategori</h4>
                                </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="kategori" name="kategori"
                                        value="{{ $data->kategori }}">
                                </div>
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <label for="gambar_kategori" class="col-sm-8 col-form-label">
                                    <h4>Gambar Kategori Produk</h4>
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
                        </form><!-- End Horizontal Form -->

                    </div>
                </div>

            </div>
        </div>
    </div>
