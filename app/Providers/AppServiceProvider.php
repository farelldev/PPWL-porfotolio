<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

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
        RateLimiter::for('portfolio-api', fn (Request $r) =>
            Limit::perMinute(60)->by($r->ip()));

        RateLimiter::for('contact', fn (Request $r) =>
            Limit::perMinute(3)->by($r->ip()));
    }
}
