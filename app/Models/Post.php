<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    //post belongs to user
    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }

    //post has many category_posts
    public function categoryPosts(){
        return $this->hasMany(CategoryPost::class);
    }

    //post has many comments
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //post has many likes
    public function likes(){
        return $this->hasMany(Like::class);
    }

    //return true if $this post is liked by Auth user
    public function isLiked(){
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
        //$this = post
        //$this->likes() = get all likes of the post
        //where()  = within the likes, look for user_id = Auth user
        //exists() = return true if where() finds something
    }
}
