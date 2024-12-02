<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'content',
        'admin_id',
    ];

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function author(){
         return $this->belongsTo(User::class, 'admin_id');
    }

    public function deleteWithImages(){

        $images = json_decode($this->image, true);

        foreach ($images as $image) {
            Storage::delete($image);
        }

        $this->delete();
    }
}
