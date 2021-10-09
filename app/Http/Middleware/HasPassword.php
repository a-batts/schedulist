<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasPassword {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $withPassword = true) {
        $hasPassword = isset(Auth::user()->password) && Auth::user()->password != '';
        if ($withPassword === true) {
            if ($hasPassword)
                return $next($request);
            abort(403);
        } else {
            if ($hasPassword)
                abort(403);
            return $next($request);
        }
    }
}
