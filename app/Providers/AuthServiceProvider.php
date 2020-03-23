<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\BlogPost'=>'App\Policies\BlogPostPolicy',
        'App\User'=>'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('home.secret',function($user){
           return $user->is_admin;
        });
    //     Gate::define('update-post',function($user, $post){
    //          return $user->id==$post->id;
    //     });
    //     Gate::define('delete-post',function($user, $post){
    //         return $user->id==$post->id;
    //    });
        //
        // Gate::define('posts.update','App\Policies\BlogPostPolicy@update');
        // Gate::define('posts.delete','App\Policies\BlogPostPolicy@delete');
        //To refactor both codes above we can authorize all functions of BlogPostPolicy.php create,store,update,delete here
        // Gate::resource('posts', 'App\Policies\BlogPostPolicy');
        // Gate::before(function ($user, $ability) {
        //     if ($user->is_admin && in_array($ability, ['update','delete'])) {
        //         return true;
        //     }
        // });
        Gate::before(function ($user, $ability) {
            // if ($user->is_admin && in_array($ability, ['update','delete'])) {
            //     return true;
            // }
        });
    }
}
