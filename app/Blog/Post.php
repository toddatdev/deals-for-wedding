<?php

namespace App\Blog;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'blog_posts';
    protected $guarded = [];

    public function category(){
        return $this->belongsTo('App\Blog\Category','category_id');
    }

    public function comments(){
        return $this->hasMany('App\Blog\Comments','post_id');
    }
}
