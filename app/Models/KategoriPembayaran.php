<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPembayaran extends Model
{
    protected $table = "kategoripembayarans";
    protected $fillable =['id','kategori_pembayaran'];

}
