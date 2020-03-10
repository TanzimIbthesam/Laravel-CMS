<?php

namespace App;
use App\BlogPost;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    public function blogPost(){
       return $this->belongsToMany(BlogPost::class)->withTimestamps()->as('tagged');
    }
}
