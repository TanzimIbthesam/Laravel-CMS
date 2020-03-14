<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    //
    use SoftDeletes;
    protected $guarded=[];
    public function BlogPost(){

        return $this->belongsTo('App\BlogPost');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function scopeLatest(Builder $query){
        return $query->orderBy(static::CREATED_AT,'asc');


    }
    public static function boot()
    {
        parent::boot();
        // static::addGlobalScope(new LatestScope);
        static::creating(function (Comment $comment) {
            Cache::forget("blog-post-{$comment->blog_post_id}");
        });


    }

}
// Comment::find(1)->blogPost;
