<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckReviewer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        } elseif (Auth::user()->userType != 3) { // 2 is reviewer
            return redirect()->guest('login');
        }

        return $next($request);
    }
}
