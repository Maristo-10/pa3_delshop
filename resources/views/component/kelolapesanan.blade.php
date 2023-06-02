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
                    <table class="table table-bordered" id="list">
                        <thead class="text-center">
                            <tr>
                                <!-- <th scope="col">Pilihan</th> -->
                                <th scope="col">No</th>
                                <th scope="col">ID Pesanan</th>
                                <th scope="col">Tanggal Pesanan</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Detail Pesanan</th>
                                {{-- <th scope="col" class="col-md-2">Bukti Pembayaran</th> --}}
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                                <!-- <th scope="col">Lampiran</th> -->
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($pesanan_kapem as $index => $data)
                                <tr>
                                    <td>{{ $index + $pesanan_kapem->firstItem() }}</td>
                                    <td>{{ $data->kode }}</td>
                                    <td>{{ $data->tanggal }}</td>
                                    <td>{{ $data->nama_pengambil }}</td>
                                    <td>
                                        <a type="button" class="bi bi-exclamation-circle btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal"></a>
                                    </td>
                                    {{-- <td>
                                        <img src="/pembayaran-images/{{ $data->bukti_pembayaran }}" alt=""
                                            style="max-height: 50px">
                                    </td> --}}
                                    <td style="font-weight: bold">
                                        <div class="row">
                                            <div class="col col-12">
                                                <select class="form-control form-select-sm text-center"
                                                    style="border: none;font-weight: bold" name="f-status" id="f-status">
                                                    <option selected>{{ $data->status }}</option>
                                                    <option value="1">Selesai</option>
                                                    <option value="2">Belum Dibayar</option>
                                                    <option value="3">Sedang Diproses</option>
                                                    <option value="4">Siap Diambil</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="/detail/pesanan/{{ $data->id }}" title="Lihat Detail Pesanan"
                                            class="bi bi-eye btn btn-secondary" style="font-size: 15px"></a>
                                        <a href="/proses/ubah/status/batalkan/{{$data->id}}" title="Batalkan Pesanan"
                                            class="bi bi-x-lg btn btn-danger ml-2" style="font-size: 15px" data-bs-toggle="modal" data-bs-target="#exampleModal2"></a>
                                        <a href="/ubah/status/{{$data->id}}" class="btn btn-warning bi bi-pencil-square" style="font-size: 15px"></a>
                                    </td>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Data Pesanan</h1>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">ID Pesanan</label>
                                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $data->kode}}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Tanggal Pesanan</label>
                                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $data->tanggal }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Nama Pengambil</label>
                                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $data->nama_pengambil }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Total Pesanan</label>
                                                    <input type="text" id="disabledTextInput" class="form-control" 
                                                        placeholder="Rp. <?php $angka = $data->total_harga;
                                                                echo number_format($angka, 0, ',', '.');
                                                                ?>" disabled>
                                                </div>  
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Kategori Pembayaran</label>
                                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $data->kategori_pembayaran }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Layanan</label>
                                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $data->layanan }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Bukti Pembayaran</label>
                                                    <img src="/pembayaran-images/{{$data->bukti_pembayaran}}" width="150" class="" alt="" />
                                                    {{-- <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $data->layanan }}" disabled> --}}
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Batalkan Pesanan</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakun untuk Batalkan pesanan ini?
                                            </div>
                                            <div class="modal-footer">
                                            <a href="/proses/ubah/status/batalkan/{{$data->id}}" class="btn btn-danger">Ya</a>
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $pesanan_kapem->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    function eventStatus() {
        $('#f-status').prop('disabled', false);
    }
</script>


