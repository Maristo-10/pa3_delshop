<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    protected $primaryKey = 'id_metpem';
    protected $table = "metodepembayarans";
    protected $fillable = ['id_metpem','status_metpem', 'layanan','no_layanan','nama_pemilik','kategori_layanan','kapem'];
}
