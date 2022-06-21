<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = request()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->type !== 'client') {
            return redirect()->route('dashboard.home');
        }

        return $next($request);
    }
}
