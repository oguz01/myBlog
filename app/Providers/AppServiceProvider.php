<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();
        $categories = \App\Models\Category::withCount('posts')->orderBy('posts_count','DESC')->take(10)->get();

        \Illuminate\Support\Facades\View::share('navbar_category', $categories);
    }
}
