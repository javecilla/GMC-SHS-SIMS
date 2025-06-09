<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //parent::boot();

        RateLimiter::for('api-private', function (Request $request) {
            return Limit::perMinute(60)->by(
                optional($request->user())->id ?: $request->ip()
            );
        });

        // You can also define more named limiters here
        RateLimiter::for('api-public', function (Request $request) {
            return Limit::perMinute(30)->by($request->ip());
        });
    }
}
