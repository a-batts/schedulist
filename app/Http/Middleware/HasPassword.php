<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasPassword {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $negate = false) {
        $hasPassword = isset($request->user()->password) && strlen($request->user()->password) > 0;
        return ($hasPassword && !$negate) ? $next($request) : abort(403);
    }
}
