<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\Assignment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class HasAssignment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param $assignmentString
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $urlString = $request->route('assignment_string');

        try {
            $assignment = Assignment::where([
                'user_id' => $request->user()->id,
                'url_string' => $urlString,
            ])->firstOrFail();
            view()->share([
                'assignment' => $assignment->id,
                'title' => $assignment->name,
            ]);
            return $next($request);
        } catch (ModelNotFoundException) {
            abort(403);
        }
    }
}
