<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Comment extends Model
{
    //
    use SoftDeletes;
    public function BlogPost(){

        return $this->belongsTo('App\BlogPost');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function scopeLatest(Builder $query){
        return $query->orderBy(static::CREATED_AT,'asc');


    }
    // public static function boot()
    // {
    //     // parent::boot();
    //     // static::addGlobalScope(new LatestScope);


    // }

}
// Comment::find(1)->blogPost;
