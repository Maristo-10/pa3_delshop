<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Pesanan</th>
            <th>Tanggal Pesanan</th>
            <th>Nama Pemesan</th>
            <th>Metode Pembayaran</th>
            <th>Jumlah Produk</th>
            <th>Total Harga</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($penjualan as $index => $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->kode }}</td>
                <td>{{ $data->tanggal }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->layanan }}</td>
                <td>{{ $data->jumlah }}</td>
                <td>{{ $data->total_harga }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="5">
                Total
            </th>
            <th>
                {{ $jlh_pesanan->total }}
            </th>
            <th>
                Rp.{{ $total_harga->total }}
            </th>
        </tr>
    </tfoot>
</table>
