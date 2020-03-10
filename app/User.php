<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function blogPost()
    {
        return $this->hasMany(BlogPost::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    public function scopeWithMostBlogPosts(Builder $query)
    {
        return $query->withCount('blogPost')->orderBy('blog_post_count', 'desc');
    }
    public function scopeWithMostBlogPostslastMonth(Builder $query)
    {
    {
        return $query->withCount(['blogPost' => function (Builder $query) {
            $query->whereBetween(static::CREATED_AT, [now()->subMonths(1), now()]);
        }])->has('BlogPost', '>=', 2)
           ->orderBy('blog_post_count', 'desc');
    }
    }
}
