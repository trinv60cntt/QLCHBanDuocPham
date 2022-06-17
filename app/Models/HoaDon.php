<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HoaDon extends Model
{
    // use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected $primaryKey = 'hoaDon_id';
    protected $table = 'hoadon';
    public $timestamps = true;

    public function nhanvien() {
        return $this->belongsTo(User::class, 'nhanvien_id');
    }
}
