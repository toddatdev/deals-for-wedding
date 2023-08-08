<?php

namespace App\Blog;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'blog_post_comments';
    protected $guarded = [];

    public function posts(){
        return $this->belongsTo('App\Blog\Post','post_id');
    }
}
