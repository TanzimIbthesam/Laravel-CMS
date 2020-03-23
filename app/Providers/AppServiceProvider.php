<?php

namespace App\Providers;

use App\Http\ViewComposers\ActivityComposer;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Blade::component('component.badge','badge');
        Blade::component('component.update','update');
        Blade::component('component.card','card');
        Blade::component('component.tags','tags');
        Blade::component('component.errors','errors');

        // view()->composer(['posts.index','posts.show'],ActivityComposer::class);
        view()->composer(['*'],ActivityComposer::class);
    }
}
