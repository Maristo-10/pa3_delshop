<?php

namespace App\Imports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        return new Produk([
            'nama_produk' => $row[0],
            'harga' => $row[1],
            'jumlah_produk' => $row[2],
            'deskripsi' => $row[3],
            'role_pembeli' => $row[4],
            'kategori_produk' => $row[5]
        ]);
    }
}
