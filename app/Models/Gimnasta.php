<?php

namespace App\Models;

use App\Models\Score;
use App\Models\Equipo;
use App\Models\Picture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Gimnasta extends Model
{
    use HasFactory;

    public $timestamps = false;


    public function pictures(){
        return $this->hasMany(Picture::class);
    }

    public function scores(){
        return $this->hasMany(Score::class);
    }

    protected $fillable = ['nombre_g', 'gametag'];

}
