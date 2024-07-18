<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Sanctum\PersonalAccessToken;


class AuthOptional
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->bearerToken()){
            $token = PersonalAccessToken::findToken($request->bearerToken());
            if ($token) {
                $request->setUserResolver(function () use ($token) {
                    return $token->tokenable;
                });
            }
        }

        return $next($request);
    }
}
