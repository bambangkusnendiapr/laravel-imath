<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Latihan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table ="latihan";
    protected $guarded = [];

    public function materi(){
        return $this->belongsTo(Materi::class,'materi_id','id');
    }

    public function soalLatihans()
    {
        return $this->hasMany(SoalLatihan::class);
    }
}
