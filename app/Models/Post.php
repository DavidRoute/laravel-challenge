<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'author_id'
    ];

    /**
     * Relationships.
     */
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class,'post_tag');
    }
    
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    /**
     * Helper methods.
     */
    public function isLiked() 
    {
        return !! $this->likes()->where('user_id', auth()->id())->count();
    }
}
