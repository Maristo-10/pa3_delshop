<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = "pesanans";
    protected $fillable = ['id','kode','tanggal','jumlah_harga','status','nama_pengambil','bukti_pembayaran','user_id','nama_layanan','metode_pembayaran','modal_pesanan'];
}
