<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    protected $table = "metodepembayarans";
    protected $fillable = ['id','layanan','no_layanan','nama_pemilik','kategori_layanan','kapem'];
}
