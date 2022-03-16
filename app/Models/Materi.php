<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $table = "materi";
    protected $guarded = [];

    public function latihan(){
        return $this->hasOne(Latihan::class);
    }

    public function kuis(){
        return $this->hasOne(Kuis::class);
    }
}
