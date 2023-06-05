@php
    $no = 1;
    $no2 = 1;
@endphp
<div name="tambah-cr" id="tambah-cr">
    <div class="card-body d-sm-flex justify-content-between">
        <h6 class="col-md-7 mb-0">
            <a href="" data-bs-target="#tambah-corousel" class="btn btn-success text-white py-2 ml-2"
                data-bs-toggle="collapse">
                <i class="fa fa-plus"></i>
                <span>Tambah Data</span>
            </a>
        </h6>
    </div>
    <div class="row nav-content collapse" name="tambah-corousel" id="tambah-corousel" data-bs-parent="#tambah-cr">
        <div class="card-body d-sm-flex justify-content-between bg-white shadow rounded col-6 ml-5 mb-3">
            <form action="/tambah/corousel" method="post" enctype="multipart/form-data" class="col-md m-3">
                @csrf
                <Label for="gambar_pengguna">Gambar Corousel</Label>
                <input type="file" name="gambar_corousel" id="gambar_corousel" class="form-control col-md-8">

                <button type="submit" class="btn btn-success mt-3">Tambah</button>
            </form>
        </div>
    </div>
</div>

@foreach ($corousel as $data)
    <div class="col-10 p-3 bg-white shadow rounded m-5">
        <div class="row m-3">
            <h4 class="fs-3">Corousel {{ $no++ }}</h4>
        </div>
        <div class="form-group col-12 col-md-6 m-3">
            <label for="gambar_corousel">Gambar Corousel</label>
            <img src="/corousel-images/{{ $data->gambar_corousel }}" alt="">
        </div>
        <div name="ubah-cr-{{ $data->id }}" id="ubah-cr={{ $data->id }}">
            <div class="card-body d-sm-flex justify-content-between">
                <h6 class="col-md-7 mb-0">
                    <a href="" data-bs-target="#ubah-corousel-{{ $data->id }}"
                        class="btn btn-warning text-white py-2 ml-2" data-bs-toggle="collapse">
                        <i class="bi bi-pencil-square"></i>
                        <span>Ubah Gambar</span>
                    </a>
                    @if ($data->status == 0)
                        <a href="/aktifkan-corousel/{{$data->id}}" class="btn btn-success text-white py-2 ml-2">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Aktifkan</span>
                        </a>
                    @else
                        <a href="/non-aktifkan-corousel/{{$data->id}}" class="btn btn-danger text-white py-2 ml-2">
                            <i class="bi bi-slash-circle-fill"></i>
                            <span>Non-Aktifkan</span>
                        </a>
                    @endempty
            </h6>
        </div>
        <div class="row nav-content collapse" name="ubah-corousel" id="ubah-corousel-{{ $data->id }}"
            data-bs-parent="#ubah-cr-{{ $data->id }}">
            <div class="card-body d-sm-flex justify-content-between bg-white shadow rounded col-6 ml-5 mb-3">
                <form action="/ubah/corousel/{{ $data->id }}" method="post" enctype="multipart/form-data"
                    class="col-md m-3">
                    @csrf
                    <Label for="gambar_pengguna">Gambar Pengguna</Label>
                    <input type="file" name="gambar_corousel" id="gambar_corousel" class="form-control col-md-8">
                    <button type="submit" class="btn btn-warning mt-3">Ubah</button>
                </form>
            </div>
        </div>
    </div>


</div>
@endforeach
