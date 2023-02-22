<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticateAdmin extends Middleware
{

    protected function authenticate($request, array $guards)
    {
        // if (empty($guards)) {
        //     $guards = [null];
        // }

        // foreach ($guards as $guard) {
            if ($this->auth->guard('admin-api')->check()) {
                return $this->auth->shouldUse('admin-api');
            }

        // }

        $this->unauthenticated($request, ['admin-api']);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('adminLogin');
        } else {
            return response()->json([
                'status' => false,
                'message' => 'unauthorized'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
