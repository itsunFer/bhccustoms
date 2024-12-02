<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class changeScore extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = [
        'old_id',
        'new_id',
    ];

    public function scores(){
        return $this->belongsTo(Score::class, 'old_id');
    }

    public function scoresN(){
        return $this->belongsTo(Score::class, 'new_id');
    }
}
