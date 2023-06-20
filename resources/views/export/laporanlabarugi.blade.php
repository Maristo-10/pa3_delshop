<table>
    <thead>
        <tr>
            <!-- <th scope="col">Pilihan</th> -->
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga Beli/satuan</th>
            <th>Harga Jual/satuan</th>
            <th>Jumlah Terjual</th>
            <th>Total Harga Beli</th>
            <th>Total Harga Jual</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($produk as $index => $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->nama_produk }}</td>
                <td>{{$data->modal}}
                <td>{{$data->harga}}</td>
                <td>{{ $data->jumlah_pesanan }}</td>
                <td>{{$data->jumlah_modal}}</td>
                <td>{{$data->jumlah_harga}}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot style="background-color: #17a2b8">
        <tr>
            <th scope="col" colspan="4">
                <h5 class="fw-bold">Total</h5>
            </th>
            <th scope="col">
                <h6 class="text-center fw-bold">
                    {{ $total_terjual->jumlah_pesanan }}
                </h6>
            </th>
            <th scope="col">
                <h6 class="text-right fw-bold">
                    {{$total_modal->jumlah_modal}}
                </h6>
            </th>
            <th scope="col">
                <h6 class="text-right fw-bold">
                    {{$total_harga->harga_terjual}}
                </h6>
            </th>
        </tr>
        <tr>
            <th scope="col" colspan="5">
                    Keuntungan
            </th>
            <th scope="col" colspan="2">
                Rp. <?php
                $angka1 = $total_harga->harga_terjual;
                $angka2= $total_modal->jumlah_modal;
                $angka = $angka1 - $angka2;
                echo($angka);
                ?>
            </th>
        </tr>
    </tfoot>
</table>
