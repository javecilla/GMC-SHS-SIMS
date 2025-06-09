<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class TransformApiResponse
{
    /**
     * Handle the response transformation for API JSON responses.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): \Symfony\Component\HttpFoundation\Response  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Skip non-JSON responses like file downloads
        if (
            ! $response instanceof JsonResponse ||
            $response instanceof BinaryFileResponse
        ) {
            return $response;
        }

        // Decode original data
        $original = $response->getData(true);

        // Determine if it's a success response
        $isSuccess = $response->getStatusCode() < 400;

        // Create standardized wrapper
        $wrapped = [
            'success' => $isSuccess,
            'data'    => $isSuccess ? $original : null,
            'errors'  => $isSuccess ? null : $original,
            'meta'    => [
                'api_version' => $request->attributes->get('api_version', 'v1'),
                'timestamp'   => now()->toIso8601String(),
            ],
        ];

        // Overwrite response data
        $response->setData($wrapped);

        return $response;
    }
}
