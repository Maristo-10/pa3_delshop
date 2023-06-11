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

<div class="col-12 shadow-sm rounded mt-3 bg-white p-3">
    <div class="col-12 mt-1">
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
                    @if ($jumlah == 0)
                    <table class="table table-striped table-bordered text-center" id="list" style="min-height: 300px">
                        @else
                        <table class="table table-striped table-bordered text-center" id="list" >
                        @endif
                        <thead>
                            <tr>
                                <!-- <th scope="col">Pilihan</th> -->
                                <th scope="col">No</th>
                                <th scope="col">Nama Pengguna</th>
                                <th scope="col">Email</th>
                                <th scope="col">Request Role</th>
                                <th scope="col">Detail</th>
                                <th scope="col">Aksi</th>
                                <!-- <th scope="col">Lampiran</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @if ($jumlah == 0)
                                <th scope="col" colspan="6" class="text-center text-muted"><h4>Data Permintaan Role Masih Kosong</h4></th>
                            @else
                                @foreach ($gantiRole as $index => $data)
                                    <tr>
                                        <td>{{ $index + $gantiRole->firstItem() }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->user_role }}</td>
                                        {{-- <td>{{ $data->kategori_produk }}</td> --}}
                                        {{-- <td>{{ $data->deskripsi }}</td> --}}
                                        <td>
                                            <a type="button" class="bi bi-exclamation-circle btn btn-info"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal"></a>
                                        </td>
                                        <td>
                                            <form action="/setuju/ganti/role/{{ $data->id }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="status" id="status" value="Disetujui">
                                                <button type="submit" title="Setuju"
                                                    class="bi bi-check2 btn btn-success "></button>
                                            </form>
                                            <form action="/tolak/ganti/role/{{ $data->id }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <button type="submit" title="Tidak Setuju"
                                                    class="bi bi-x-lg btn btn-danger"></button>
                                            </form>
                                        </td>
                                        <div class="modal fade" id="exampleModal{{ $data->id_produk }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail</h1>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label">Nama
                                                                Pengguna</label>
                                                            <input type="text" id="disabledTextInput"
                                                                class="form-control" placeholder="{{ $data->name }}"
                                                                disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label">Email
                                                                Pengguna</label>
                                                            <input type="text" id="disabledTextInput"
                                                                class="form-control" placeholder="{{ $data->email }}"
                                                                disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label">Request
                                                                Role</label>
                                                            <input type="text" id="disabledTextInput"
                                                                class="form-control"
                                                                placeholder="{{ $data->user_role }}" disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="bukti" class="form-label">Bukti</label>
                                                            <a href="/ganti-roles-images/{{ $data->bukti }}">
                                                                <img src="/ganti-roles-images/{{ $data->bukti }}"
                                                                    alt="Product Image" width="150" class=""
                                                                    name="bukti" id="bukti">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                @endforeach
                            @endif

                        </tbody>

                    </table>
                    {{ $gantiRole->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end n-link" style="text-decoration: none">
    {{-- {{ $produk->links() }} --}}
</div>
</div>
