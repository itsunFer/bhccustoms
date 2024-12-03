<?php

namespace App\Models;

use App\Models\Gimnasta;
use App\Models\competencias;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Score extends Model
{
    use HasFactory;

    public $timestamps = false;

    use SoftDeletes;

    protected $fillable = ['competencias_id', 
    'gametag',
    'winloss',
    'acs',
    'kills',
    'deaths',
    'assists',
    'dd',
    'adr',
    'hs',
    'kast',
    'fk',
    'fd',
    'rank',
    'plants',
    'defuses'];

    public function competencias(){
        return $this->belongsTo(Competencias::class);
    }

    public function changeScores(){
        return $this->hasMany(changeScore::class);
    }

    public function changeScoresN(){
        return $this->hasMany(changeScore::class);
    }

    public function getGametagAttribute($value){
        return str_replace(' #', '#', $value);
    }

    public function setGametagAttribute($value){
        $this->attributes['gametag'] = str_replace(' #', '#', $value);
    }
}
