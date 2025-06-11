<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    /**
     * TODO: Add additionally validation for internal use.
     * Only allow access to the route if the supplied token input matches a specified value.
     * Otherwise, we will redirect the users back to the /home URI:
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->input('token') !== env('APP_TOKEN')) {
            //return redirect('/home');
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}