<?php

namespace App;
use App\BlogPost;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    public function blogPost(){
        $this->belongsToMany(BlogPost::class);
    }
}
