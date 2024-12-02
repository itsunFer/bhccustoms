<?php

namespace App\Models;

use App\Models\Gimnasta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Picture extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function gimnastas(){
        return $this->belongsTo(Gimnasta::class);
    }

    protected $fillable = [
        'hash',
        'nombre',
        'extension',
        'mime',
    ];
}
