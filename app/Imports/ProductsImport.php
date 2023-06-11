<?php

namespace App\Imports;

use App\Models\KategoriProdukModel;
use App\Models\Produk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        $kategori = KategoriProdukModel::where('kategori', $row['kategori_produk'])->first();
        if(!$kategori) {
            $kategori = KategoriProdukModel::create(
                [
                    'kategori' => $row['kategori_produk'],
                ]
                );
        }
        return new Produk([
            'nama_produk' => $row['nama_produk'],
            'harga' => $row['harga'],
            'jumlah_produk' => $row['jumlah_produk'],
            'deskripsi' => $row['deskripsi'],
            'role_pembeli' => $row['role_pembeli'],
            'kategori_produk' => $kategori->kategori,
            'ukuran_produk' => $row['ukuran_produk'],
            'warna' => $row['warna'],
            'angkatan' => $row['angkatan']
        ]);
    }
}
