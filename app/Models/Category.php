<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //category has many category_posts
    public function categoryPosts(){
        return $this->hasMany(CategoryPost::class);
    }
}
