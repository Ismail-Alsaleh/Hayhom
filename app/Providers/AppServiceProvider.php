<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Spatie\ResponseCache\ResponseCacheServiceProvider;

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
        $this->app->register(ResponseCacheServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $locale = request()->segment(1);
        App::setLocale($locale);
        Config::set('app.locale', $locale);
    }
}
