<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Crypt;
use App\Models\Assignment;
use Illuminate\Http\Request;

class HasAssignment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $assignment_string)
    {
        $assignment_string = $request->route('assignment_string');
        $intendedAssignment = Assignment::where('userid', Auth::user()->id)->where('url_string', $assignment_string)->first();
        if ($intendedAssignment != null){
          $current_assignment_title = Crypt::decryptString($intendedAssignment->assignment_name);
          view()->share('current_assignment_title', $current_assignment_title);
          return $next($request);
        }
        else{
          abort(404);
        }
    }
}
