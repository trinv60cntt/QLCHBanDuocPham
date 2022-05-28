<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Social extends Model
{
    // use SoftDeletes;
    protected $guarded = [];
    protected $primaryKey = 'user_id';
    protected $table = 'social';

    public function login() {
      return $this->belongsTo(KhachHang::class, 'khachhang_id');
    }
}
