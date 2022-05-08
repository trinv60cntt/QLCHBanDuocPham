<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongKe extends Model
{
    // use HasFactory;
    // use SoftDeletes;
    protected $guarded = [];
    protected $primaryKey = 'thongKe_id';
    protected $table = 'thongke';
}
