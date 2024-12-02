<?php

namespace App\Models;

use App\Models\Score;
use App\Models\Equipo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['nombre_e', 
    'fecha_i_e',
    'fecha_f_e',
    'paises_id',
    'competencias_id',
    'user_id'];
    
    public function competencias(){
        return $this->belongsTo(Competencia::class);
    }

    public function paises(){
        return $this->belongsTo(Pais::class);
    }

    public function scores(){
        return $this->hasMany(Score::class);
    }

    public function equipos(){
        return $this->hasMany(Equipo::class);
    }

    protected function nombreE(): Attribute{
        return new Attribute(
            set: fn($value) => ucwords($value) 
        );
    }
 
}
