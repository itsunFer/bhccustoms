<?php

namespace App\Models;

use App\Models\Score;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

class Competencia extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['map', 'winners','score'];

    public function scores(){
        return $this->hasMany(Score::class);
    }

}
