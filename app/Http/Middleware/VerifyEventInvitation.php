<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Event;

use Carbon\Carbon;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class VerifyEventInvitation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next){
      $eventId = $request->route('id');
      $user = $request->route('user') ?? null;

      if (isset($user) && $user != Auth::User()->id)
        abort(401);

      $event = Event::find($eventId);
      if ($event == null)
        return redirect()->route('schedule');

      $shared = explode(',', $event->shared_with);
      if (isset($user) && ! in_array(Auth::User()->id, $shared))
        view()->share('invalidEvent', true);

      view()->share('initDate', Carbon::parse($event->date));
      return $next($request);
    }
}
