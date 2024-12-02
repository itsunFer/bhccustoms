<?php

namespace App\Models;

use App\Models\Equipo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pais extends Model
{
    use HasFactory;

    protected $table = 'paises';

    public $timestamps = false;

    public function gimnastas(){
        return $this->hasMany(Gimnasta::class);
    }

    public function events(){
        return $this->hasMany(Event::class);
    }

    public function equipos(){
        return $this->hasMany(Equipo::class);
    }
}
