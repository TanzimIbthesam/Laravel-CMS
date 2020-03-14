<?php

namespace App;

use App\Scope\DeletedAdminScope;
use App\Scope\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use App\Tag;

class BlogPost extends Model
{
    // protected $table = 'blogposts';

    use SoftDeletes;

    // protected $fillable = ['title', 'content', 'user_id'];
    protected $guarded=[''];

    public function comment()
    {
        return $this->hasMany('App\Comment')->latest();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
   public function scopeLatest(Builder $query){
       return $query->orderBy(static::CREATED_AT,'desc');


   }
   public function scopemostCommented(Builder $query){
       //we will produce a field name comments count
    //   return $query->withCount('comment')->orderBy('comments_count','desc');
    return $query->withCount('comment')->orderBy('comment_count', 'desc');
   }
   public function tags(){
       return $this->belongsToMany(Tag::class)->withTimestamps()->as('tagged');
   }
   public function scopelatestwithRelations(Builder $query ){
           return $query->latest()
           ->withCount('comment')
           ->with('user')
           ->with('tags');
   }

    public static function boot()
    {

        // static::addGlobalScope(new LatestScope);
        static::addGlobalScope(new DeletedAdminScope);
        parent::boot();

        static::deleting(function (BlogPost $blogPost) {
            $blogPost->comment()->delete();
        });
        static::updating(function (BlogPost $blogPost) {
           Cache::forget("blog-post-{$blogPost->id}");
        });

        static::restoring(function (BlogPost $blogPost) {
            $blogPost->comment()->restore();
        });

    }
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
