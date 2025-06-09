<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ForceJsonResponse
{
    /**
     * Handle an incoming request and force all responses to be JSON.
     *
     * This middleware ensures consistent API behavior by modifying the Accept header.
     * Exceptions can be added for specific paths (e.g., docs, public pages).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): \Symfony\Component\HttpFoundation\Response  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        // Define routes or patterns that should skip JSON forcing
        $excludedRoutes = [
            'public-docs/*',        // Example: GET /public-docs/v1
            'no-json/*',            // Example: Routes where HTML or XML might be served
        ];

        // Check if current route is excluded (using wildcard match)
        foreach ($excludedRoutes as $pattern) {
            if ($request->is($pattern)) {
                return $next($request); // Skip forcing JSON
            }
        }

        // Only override Accept if it's not already JSON (or missing)
        if (!$request->expectsJson()) {
            // TODO: log that we are overriding Accept
            if (app()->environment('local')) {
                Log::info('ForceJsonResponse: Overriding Accept header to application/json', [
                    'uri' => $request->getRequestUri(),
                    'original_accept' => $request->header('Accept'),
                ]);
            }

            // Force the Accept header to application/json
            $request->headers->set('Accept', 'application/json');
        }

        return $next($request);
    }
}
