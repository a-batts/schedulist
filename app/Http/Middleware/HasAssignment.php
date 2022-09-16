<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\Assignment;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class HasAssignment {
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @param $assignmentString
   * @return mixed
   */
  public function handle(Request $request, Closure $next) {
    $assignmentString = $request->route('assignment_string');
    $assignment = Assignment::where('userid', Auth::user()->id)->where('url_string', $assignmentString)->first();
    if ($assignment != null) {
      $assignmentTitle = $assignment->assignment_name;
      view()->share(['assignment' => $assignment->id, 'assignmentTitle' => $assignmentTitle]);
      return $next($request);
    }
    abort(403);
  }
}
