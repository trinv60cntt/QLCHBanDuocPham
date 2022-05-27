<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongKe extends Model
{
    // use HasFactory;
    // protected $guarded = [];
    // protected $primaryKey = 'hoaDon_id';
    // protected $table = 'chitiethd';

    public function sanpham() {
      return $this->belongsTo(SanPham::class, 'sanPham_id');
    }
}
