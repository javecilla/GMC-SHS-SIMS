<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->encryptCookies(except: ['appearance', 'sidebar_state']);

        $middleware->append([
            // Global middleware here
            \App\Http\Middleware\HandleCors::class
        ]);

        $middleware->web(append: [
            \App\Http\Middleware\HandleAppearance::class,
            \App\Http\Middleware\HandleInertiaRequests::class,
            \App\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        $middleware->api(append: [
            // API middleware here
            \App\Http\Middleware\ForceJsonResponse::class,
            \App\Http\Middleware\TransformApiResponse::class,
            \App\Http\Middleware\LogApiRequests::class,
        ]);

        $middleware->alias([
            'api.version' => \App\Http\Middleware\ApiVersion::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
