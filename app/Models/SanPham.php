<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    // use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'sanPham_id';

    public function danhmuc() {
        return $this->belongsTo(DanhMuc::class, 'danhMuc_id');
    }
}
