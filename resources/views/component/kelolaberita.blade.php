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

@if ($jumlah->total < 3)
    <div class="card-body d-sm-flex justify-content-between">
        <h6 class="col-md-12 mb-0">
            <a href="/tambah-berita" class="btn btn-success text-white ml-2">
                <i class="fa fa-plus"></i>
                <span>Tambah Data Berita</span>
            </a>
        </h6>
    </div>
    </div>
@else
    <div class="card-body d-sm-flex justify-content-between">
        <h6 class="col-md-12 mb-0">
            <button class="btn btn-success text-white ml-2" disabled>
                <i class="fa fa-plus"></i>
                <span>Tambah Data Berita</span>
            </button>
            <br>
            <small class="bi bi-info-circle text-danger"> Berita dengan status aktif maksimal 3 </small><br>
            <small class="bi bi-info-circle text-danger"> Ubah status salah satu Berita menjadi "Non-Aktif" terlebih
                dahulu untuk menambah dan mengaktifkan berita! </small>
        </h6>
    </div>
@endif



<div class="row">
    <div class="col-md shadow-sm rounded justify-content-center bg-white">
        <div class="table-responsive-sm table-wrapper-scroll-y my-custom-scrollbar">
            <div class="card">
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <table class=" col-12 table table-striped table-bordered" id="list">
                        <thead>
                            <tr>
                                <th scope="col" class="">No</th>
                                <th scope="col" class="col-md-3">Judul</th>
                                <th scope="col" class="col-md-3">Subjudul</th>
                                <th scope="col" class="col-md-3">Descripsi</th>
                                <th scope="col" class="col-md-1">Status</th>
                                <th scope="col" class="col-md-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($beritas as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->title }}</td>
                                    <td>{{ $data->subtitle }}</td>
                                    <td>{{ $data->description }}</td>
                                    <td>{{ $data->status }}</td>
                                    <td class="text-center">
                                        <a href="/ubahberita/{{ $data->id }}" title="Ubah Berita"
                                            class="bi bi-pencil-square btn btn-warning "
                                            style="font-size: 15px"></a>
                                        @if ($data->status == 'Aktif')
                                            <a title="Non-Aktifkan Berita"
                                                href="/nonaktifkan-berita/{{ $data->id }}"
                                                class="bi bi-slash-circle-fill btn btn-danger ml-2"
                                                style="font-size: 15px"></a>
                                        @else
                                            @if ($jumlah->total < 3)
                                                <a title="Aktifkan Berita"
                                                    href="/aktifkan-berita/{{ $data->id }}"
                                                    class="bi bi-check-circle-fill btn btn-success ml-2"
                                                    style="font-size: 15px"></a>
                                            @else
                                                <Button title="Aktifkan Berita"
                                                    class="bi bi-check-circle-fill btn btn-success ml-2"
                                                    style="font-size: 15px" disabled></Button>
                                            @endif
                                        @endif
                                    </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end n-link" style="text-decoration: none">
    {{ $beritas->links() }}
</div>
</div>
