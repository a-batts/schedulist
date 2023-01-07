<?php

namespace App\Http\Middleware;

use App\Http\Livewire\Schedule\EventInvite;
use Closure;

use App\Models\Event;
use App\Models\EventUser;
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
    public function handle(Request $request, Closure $next)
    {
        $user = $request->route('user_id') ?? null;
        if (isset($user) && $user != $request->user()->id) {
            abort(401);
        }

        $event = Event::find($request->route('event_id'));
        if ($event == null || ($event->public == false && !isset($user))) {
            return redirect()->route('schedule');
        }

        //Create an invitation if the event is public so the user can save it
        if ($event->public) {
            $invite = EventUser::firstOrNew([
                'user_id' => $request->user()->id,
                'event_id' => $event->id,
            ]);
            $invite->save();
        }

        view()->share('initDate', Carbon::parse($event->date));
        return $next($request);
    }
}
