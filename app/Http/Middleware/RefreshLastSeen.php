<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class RefreshLastSeen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && now()->diffInMinutes($request->user()->last_seen) >= Config::get('constants.inactivity_minutes'))
        {
            $request->user()->last_seen = now();
            $request->user()->update();
        }
        return $next($request);
    }
}
