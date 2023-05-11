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
<div class="card-body d-sm-flex justify-content-between">
    <h6 class="col-md-7 mb-0">
        <a href="/tambahpengguna" class="btn btn-success text-white py-2 ml-2 col-md-5">
            <i class="fa fa-plus"></i>
            <span>Tambah Data Pengguna</span>
        </a>
    </h6>
    <h6 class="col-md-5 mb-0">
        <a href="tambahpengguna/import" class="btn btn-success text-white py-2 ml-2 col-md-6">
            <i class="fa fa-plus"></i>
            <span>Import data excel</span>
        </a>
    </h6>
</div>

<div class="row col-10 shadow-sm rounded mt-3 bg-white p-3">
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
                    <table class="table table-striped table-bordered" id="list">
                        <thead>
                            <tr>
                                <th scope="col" class="col-md-1">No</th>
                                <th scope="col" class="col-md-3">Nama Pengguna</th>
                                <th scope="col" class="col-md-3">Email</th>
                                <th scope="col" class="col-md-2">Role Pengguna</th>
                                <th scope="col" class="col-md-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @php
                                $no = 1;
                            @endphp --}}
                            @foreach ($pengguna as $index => $data)
                                <tr>
                                    <td>{{ $index + $pengguna->firstItem() }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->role_pengguna }}</td>
                                    <td style="text-align: center">
                                        <a href="/ubahpengguna/{{ $data->id}}" title="Ubah Data" class="bi bi-pencil-square btn btn-warning " style="font-size: 15px"></a>
                                        <a href="/hapus/pengguna/{{ $data->id}}" title="Hapus Data"class="bi bi-trash-fill btn btn-danger ml-2" style="font-size: 15px"></a>
                                    </td>
                            @endforeach
                        </tbody>

                    </table>
                    <div class="row">
                        <div class="col-md-12">
                            {{ $pengguna->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
