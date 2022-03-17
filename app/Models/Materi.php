<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Materi extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "materi";
    protected $guarded = [];

    public function pengetahuans()
    {
        return $this->hasMany(Pengetahuan::class);
    }

    public function latihan(){
        return $this->hasOne(Latihan::class);
    }

    public function kuis(){
        return $this->hasOne(Kuis::class);
    }
}
