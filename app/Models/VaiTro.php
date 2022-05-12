<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaiTro extends Model
{
    // use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'vaiTro_id';
    protected $table = 'vai_tros';
}
