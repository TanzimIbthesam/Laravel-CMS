<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    //
    use SoftDeletes;
    public function BlogPost(){
        return $this->belongsTo('App\BlogPost');
    }
}
// Comment::find(1)->blogPost;
