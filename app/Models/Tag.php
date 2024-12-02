<?php

namespace App\Models;

use App\Models\Forum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'tag_name',
    ];

    public function forums()
    {
        return $this->belongsToMany(Forum::class);
    }   
}
