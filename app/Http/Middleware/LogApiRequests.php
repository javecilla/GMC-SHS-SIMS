<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogApiRequests
{
    /**
     * Handle an incoming request and log details about it.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): \Symfony\Component\HttpFoundation\Response  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);

        $response = $next($request);

        $duration = round(microtime(true) - $startTime, 4);

        Log::channel('api')->info('API Request', [
            'method' => $request->method(),
            'uri' => $request->path(),
            'status' => $response->getStatusCode(),
            'duration_seconds' => $duration,
            'user_id' => optional($request->user())->id,
            'ip' => $request->ip(),
        ]);

        return $response;
    }
}
