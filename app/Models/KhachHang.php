<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KhachHang extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $primaryKey = 'khachhang_id';
    protected $table = 'khachhang';
}
