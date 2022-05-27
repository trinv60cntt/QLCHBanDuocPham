<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhGiaSao extends Model
{
  // use HasFactory;
  protected $guarded = [];
  protected $primaryKey = 'sao_id';
  protected $table = 'danhgiasao';

}
