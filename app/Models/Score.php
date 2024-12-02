<?php

namespace App\Models;

use App\Models\Event;
use App\Models\Round;
use App\Models\Aparato;
use App\Models\Gimnasta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Score extends Model
{
    use HasFactory;

    public $timestamps = false;

    use SoftDeletes;

    protected $fillable = ['gimnastas_id', 
    'events_id',
    'rounds_id',
    'aparatos_id',
    'difficulty_s',
    'execution_s',
    'deductions_s',
    'total_s',
    'user_id',
    'approved',
    'edited'];

    public function gimnastas(){
        return $this->belongsTo(Gimnasta::class);
    }

    public function events(){
        return $this->belongsTo(Event::class);
    }

    public function rounds(){
        return $this->belongsTo(Round::class);
    }

    public function aparatos(){
        return $this->belongsTo(Aparato::class);
    }

    public function changeScores(){
        return $this->hasMany(changeScore::class);
    }

    public function changeScoresN(){
        return $this->hasMany(changeScore::class);
    }
}
