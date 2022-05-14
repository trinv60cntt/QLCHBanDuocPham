<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quyen extends Model
{
    // use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'quyen_id';
    protected $table = 'quyens';

    public function quyenChildren() {
        return $this->hasMany(Quyen::class, 'parent_id');
    }
}
