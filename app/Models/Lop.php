<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Lop extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $fillable = ['MaLop', 'TenLop'];
    protected $primaryKey = 'MaLop';
    public $incrementing = false;
    protected $keyType = 'string';
}