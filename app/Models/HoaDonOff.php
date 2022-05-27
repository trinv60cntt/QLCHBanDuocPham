<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HoaDonOff extends Model
{
  // use HasFactory;
  use SoftDeletes;
  protected $guarded = [];
  protected $primaryKey = 'hoaDonOff_id';
  protected $table = 'hoadonoff';
  public $timestamps = true;

  public function nhanvien() {
    return $this->belongsTo(NhanVien::class, 'nhanvien_id');
  }
}
