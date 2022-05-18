<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SecretKeyMiddleware
{
    /**
     * @throws \Illuminate\Http\Client\HttpClientException
     */
    public function handle(Request $request, Closure $next)
    {
        Log::info('Header',[$request->header('X-Secret-Key')]);
        if (env('SECRET_KEY') !== $request->header('X-Secret-Key')) {
            throw new HttpClientException('Incorrect Secret Key', 403);
        }

        return $next($request);
    }
}
