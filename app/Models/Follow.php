<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    public $timestamps = false;
    
    //follow belongs to user (opposite to follows())
    public function followed(){
        return $this->belongsTo(User::class, 'followed_id')->withTrashed();
    }

    //follow belongs to user (opposite of followers())
    public function follower(){
        return $this->belongsTo(User::class, 'follower_id')->withTrashed();
    }
}
