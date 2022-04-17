<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DanhMuc extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'danhMuc_id';
    protected $fillable = ['tenDM', 'danhMucCha_id'];
    protected $table = 'danh_mucs';

    public function sanphams() {
        return $this->hasMany('danhMuc_id');
    }

}
