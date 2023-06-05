<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corousel extends Model
{
    protected $table = "corousels";
    protected $fillable =['gambar_corousel','status'];
}
