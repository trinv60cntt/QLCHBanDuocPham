<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HoaDon extends Model
{
    // use HasFactory;
    // use SoftDeletes;
    protected $guarded = [];
    protected $primaryKey = 'hoaDon_id';
    protected $table = 'hoadon';
    public $timestamps = true;
    // public function danhmuc() {
    //     return $this->belongsTo(DanhMuc::class, 'danhMuc_id');
    // }

    // public function nhasanxuat() {
    //     return $this->belongsTo(NhaSanXuat::class, 'NSX_id');
    // }
    
}
