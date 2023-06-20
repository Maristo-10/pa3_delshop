<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    protected $table = "pesanandetails";
    protected $fillable = ['id','jumlah','jumlah_harga','produk_id','pesanan_id','modal_details'];
}
