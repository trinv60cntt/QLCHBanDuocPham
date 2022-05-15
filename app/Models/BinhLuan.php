<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class BinhLuan extends Model
{
  // use SoftDeletes;
  protected $guarded = [];
  protected $primaryKey = 'binhLuan_id';
  protected $table = 'binhluan';

  public function sanpham() {
    return $this->belongsTo(SanPham::class, 'sanPham_id');
}
}
