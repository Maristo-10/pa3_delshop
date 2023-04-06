<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $primaryKey = 'id_produk';
    protected $table = "produk";
    protected $fillable = ['id_produk','gambar_produk','nama_produk','harga','jumlah_produk','deskripsi','status_produk','produk_unggulan','role_pembeli','kategori_produk'];
}
