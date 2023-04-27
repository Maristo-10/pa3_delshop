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
        <div class="table-responsive-sm table-wrapper-scroll-y my-custom-scrollbar text-center">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered" id="list">
                        <thead>
                            <tr>
                                <!-- <th scope="col">Pilihan</th> -->
                                <th scope="col" class="">No</th>
                                <th scope="col" class="col-md-1">Tanggal Pesanan</th>
                                <th scope="col" class="col-md-1">Total Harga</th>
                                <th scope="col" class="col-md-2">Nama Pengambil</th>
                                <th scope="col" class="col-md-1">Metode Pembayaran</th>
                                <th scope="col" class="col-md-1">Nama Layanan</th>
                                <th scope="col" class="col-md-2">Bukti Pembayaran</th>
                                <th scope="col" class="col-md-2">Status</th>
                                <th scope="col" class="col-md-2">Aksi</th>
                                <!-- <th scope="col">Lampiran</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($pesanan_kapem as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->tanggal }}</td>
                                    <td>Rp. <?php
                                    $angka = $data->total_harga;
                                    echo number_format($angka, 0, ',', '.');
                                    ?></td>
                                    <td>{{ $data->nama_pengambil }}</td>
                                    <td>{{ $data->kategori_pembayaran }}</td>
                                    <td>{{ $data->nama_layanan }}</td>
                                    <td>
                                        <img src="/pembayaran-images/{{ $data->bukti_pembayaran }}" alt=""
                                            style="max-height: 50px">
                                    </td>
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
                                        <a href="/prosesubahstatusproduk/nonaktif/" title="Batalkan Pesanan"
                                            class="bi bi-x-lg btn btn-danger ml-2" style="font-size: 15px"></a>
                                        <a href="/ubah/status/{{$data->id}}" class="btn btn-warning bi bi-pencil-square" style="font-size: 15px"></a>
                                    </td>
                            @endforeach
                        </tbody>

                    </table>
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


