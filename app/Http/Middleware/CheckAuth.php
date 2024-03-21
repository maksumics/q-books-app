<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $expiration = session('expiration_time');
        session(['expiration_time' => now()->addMinutes(90)]);

        if (empty($expiration) || now()->gt($expiration)) {
            session()->forget('token_key');
        }

        if (!session()->has('token_key')) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
