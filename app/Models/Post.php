<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Mass assignment ke liye fields allow karni hongi
    protected $fillable = ['title', 'content', 'user_id'];

    /**
     * Har post ek user (author) se belong karti hai
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Har post ke multiple comments ho sakte hain
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
