<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id','user_id','content','status'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
{
    return $this->hasMany(Comment::class);
}

// sirf approved comments
public function approvedComments()
{
    return $this->hasMany(Comment::class)->where('status', 'approved');
}

}
