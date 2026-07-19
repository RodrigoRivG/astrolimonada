<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Photo;
use App\Models\Comment;

class Post extends Model
{
    protected $fillable = [
        'title',
        'description',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function usersWhoFavorited() {
        return $this->belongsToMany(User::class, 'favorites', 'post_id', 'user_id');
    }

    public function photos() {
        return $this->hasMany(Photo::class, 'post_id', 'id');
    }

    public function comments() {
        return $this->hasMany(Comment::class,'post_id', 'id');
    }
}
