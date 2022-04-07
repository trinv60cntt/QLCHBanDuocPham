<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class NhaSanXuat extends Model
{
    // use SoftDeletes;
    protected $primaryKey = 'NSX_id';
    protected $fillable = ['tenNSX', 'nuocSX'];
}
