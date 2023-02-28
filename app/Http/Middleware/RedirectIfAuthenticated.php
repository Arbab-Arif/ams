<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? ['web', 'admin'] : $guards;

        foreach ($guards as $guard) {

            if (Auth::guard($guard)->check()) {
                $route = 'HOME';
                if (!is_null($guard) && $guard != 'web') $route = Str::upper($guard).'_HOME';
                return redirect(constant("\App\Providers\RouteServiceProvider::$route"));
            }
        }
        return $next($request);
    }
}
