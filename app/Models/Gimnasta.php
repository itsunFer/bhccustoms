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

    public function paises(){
        return $this->belongsTo(Pais::class);
    }

    public function pictures(){
        return $this->hasMany(Picture::class);
    }

    public function scores(){
        return $this->hasMany(Score::class);
    }

    public function equipos(){
        return $this->belongsToMany(Equipo::class)->withPivot('alternate_g');
    }

    protected $fillable = ['nombre_g', 'apellido_g', 'fecha_n_g', 'paises_id',];

    protected function nombreG(): Attribute{
        return new Attribute(
            set: fn($value) => ucwords($value) //mutator, cambia la primera letra a mayúscula
        );
    }

    protected function apellidoG(): Attribute{
        return new Attribute(
            set: fn($value) => ucwords($value) 
        );
    }
}
