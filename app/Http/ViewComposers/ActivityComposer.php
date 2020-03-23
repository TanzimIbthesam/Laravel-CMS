<?php


namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\BlogPost;
use App\User;
use Illuminate\Support\Facades\Cache;


class ActivityComposer{
    public function compose(View $view) {
        $most_commented=Cache::remember('blog-post-commented', now()->addSeconds(30), function () {
            return  BlogPost::mostCommented()->take(5)->get();
        });
        $mostActive=Cache::remember('users-most-active', now()->addSeconds(30), function () {
            return  User::WithMostBlogPosts()->take(5)->get();
        });
        $mostActiveLastMonth=Cache::remember('users-most-active-last-month', now()->addSeconds(30), function () {
            return User::withMostBlogPostsLastMonth()->take(5)->get();
        });
        $view->with('most_commented',$most_commented);
        $view->with('mostActive',$mostActive);
        $view->with('mostActiveLastMonth',$mostActiveLastMonth);
    }
}


