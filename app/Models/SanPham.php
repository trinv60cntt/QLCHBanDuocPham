<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SanPham extends Model
{
    // use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected $primaryKey = 'sanPham_id';

    public function danhmuc() {
        return $this->belongsTo(DanhMuc::class, 'danhMuc_id');
    }
}
