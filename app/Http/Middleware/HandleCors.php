<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleCors
{
    /**
     * Handle an incoming request.
     *
     * This middleware adds the necessary CORS headers to every response,
     * and handles OPTIONS preflight requests by returning an early response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // If this is a preflight OPTIONS request, respond immediately with allowed headers
        if ($request->isMethod('OPTIONS')) {
            return response()->noContent(204)
                ->header('Access-Control-Allow-Origin', '*') // Allow all origins - replace '*' with your domain(s) in production
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS') // Allowed HTTP methods
                ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization') // Allowed headers from client
                ->header('Access-Control-Allow-Credentials', 'true'); // Allow credentials like cookies or auth headers
        }

        // For all other requests, handle the request and then add CORS headers to the response
        $response = $next($request);

        // Allow all origins - in production, change '*' to your front-end URL(s)
        $response->headers->set('Access-Control-Allow-Origin', '*');

        // Allow the following HTTP methods
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

        // Allow these headers in requests sent to the server
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        // Allow cookies and auth headers to be sent
        $response->headers->set('Access-Control-Allow-Credentials', 'true');

        return $response;
    }
}
