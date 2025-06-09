<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiVersion
{
    /**
     * Handle the incoming request by attaching API version to attributes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): \Symfony\Component\HttpFoundation\Response  $next
     * @param  string  $version  The API version from route middleware parameter.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $version): Response
    {
        // Attach the version to the request attributes for later use (e.g. logging, controller logic)
        $request->attributes->set('api_version', $version);

        return $next($request);
    }
}
