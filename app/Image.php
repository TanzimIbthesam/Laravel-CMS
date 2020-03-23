<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //

    protected $guarded=[''];
    // protected $fillable = ['thumbnail', 'blog_post_id'];
    // public function BlogPost(){
    //     return $this->belongsTo(BlogPost::class);
    // }

        public function imageable()
        {
            return $this->morphTo();
        }

}
