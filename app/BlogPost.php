<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;
    //
    // protected $fillable=['title','content'];
    protected $guarded=[''];

    public function comment(){
        return $this->hasMany('App\Comment');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function (BlogPost $blogPost) {
            $blogPost->comment()->delete();
        });

        static::restoring(function (BlogPost $blogPost) {
            $blogPost->comment()->restore();
        });
    }
    //It is used in case of
    // public static function boot(){
    //     // parent::boot();
    //     // static::deleting(function (BlogPost $blogPost){
    //     // //   dd('I was deleted');
    //     // $blogPost->comment()->delete();
    //     // });
    // }
}
//Tinker
//   $comment->content='Fourth';
// $bp=BlogPost::find(2);
// $comment=new App\Comment;
// $comment=new App\Comment;
//$comment->content='First Comment';
// $comment2=new App\Comment;
// $comment2->content='Second New Comment';
//To save it $bp->comment()->save($comment);
//For adding multiple new comments
//$bp->comment()->saveMany([$comment,$comment2]);
//To get all blogpost with comment
// BlogPost::with('comment');
// $post=BlogPost::with('comment')->get();
// $post=BlogPost::find(5);
//$post
//Lazy loading
//$post->comment;
// $content=Comment::find(5);
//$content;
//To find comment of relevant blogpost via lazy loading
//$content->blogPost;
// $comment::find(5);

//$content;
