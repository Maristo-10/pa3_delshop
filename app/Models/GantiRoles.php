<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GantiRoles extends Model
{
    protected $table = "gantiroles";
    protected $fillable = ['id','name','email','user_role','bukti','status','user_id'];
}
