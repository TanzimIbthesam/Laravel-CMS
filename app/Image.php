<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $guarded=[''];
    public function BlogPost(){
        return $this->belongsTo(BlogPost::class);
    }
}
