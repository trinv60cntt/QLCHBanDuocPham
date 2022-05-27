<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietHDOff extends Model
{
  // use HasFactory;
  protected $guarded = [];
  protected $primaryKey = 'hoaDonOff_id';
  protected $table = 'chitiethdoff';

    // public function sanpham() {
    //     return $this->belongsTo(SanPham::class, 'sanPham_id');
    // }
}
