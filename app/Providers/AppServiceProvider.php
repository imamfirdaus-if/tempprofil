<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Config::set('services.wordpress.endpoint', config('services.wordpress.endpoint', 'https://uinsgd.ac.id/wp-json/wp/v2/posts?_embed&per_page=3'));
    }
}
