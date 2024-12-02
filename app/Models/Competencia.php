<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

class Competencia extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['nombre_c', 'tipo_c',];

    public function events(){
        return $this->hasMany(Event::class);
    }

    protected function nombreC(): Attribute{
        return new Attribute(
            set: fn($value) => ucwords($value) 
        );
    }
}
