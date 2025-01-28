<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    protected $table = 'category_post'; //table name is not in plural form, so note the different table name
    public $timestamps = false; //do not auto-save timestamps
    protected $fillable = ['category_id', 'post_id']; // for create() 

    //category_post belongs to category
    public function category(){
        return $this->belongsTo(Category::class);
    }

    //category_post belongs to post
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
