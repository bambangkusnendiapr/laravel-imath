<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JawabanLatihan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jawaban_latihan';
    protected $guarded = [];

    public function soalLatihan()
    {
        return $this->belongsTo(SoalLatihan::class);
    }
}
