<?php

namespace App\Http\Controllers;

use App\Models\EventUser;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class EventInviteController extends Controller
{
    public function accept(Request $request)
    {
        try {
            $event = $request
                ->user()
                ->invites()
                ->findOrFail($request->id);

            $invite = EventUser::where([
                'event_id' => $event->id,
                'user_id' => $request->user()->id,
            ])->firstOrFail();
            $invite->accepted = true;
            $invite->save();

            return response()->json(
                ['success' => 'Added the event to your agenda.'],
                200
            );
        } catch (ModelNotFoundException) {
            return response()->json(
                [
                    'error' =>
                        'You can only make this request if you have been invited to this event.',
                ],
                401
            );
        }
    }

    public function decline(Request $request)
    {
        try {
            $event = $request
                ->user()
                ->invites()
                ->findOrFail($request->id);

            if ($request->user()->id == $event->owner) {
                return response()->json(
                    ['error' => 'You cannot decline an event that you own.'],
                    401
                );
            }

            $invite = EventUser::where([
                'event_id' => $event->id,
                'user_id' => $request->user()->id,
            ])->firstOrFail();
            $invite->delete();

            return response()->json(
                ['success' => 'Declined the invitation.'],
                200
            );
        } catch (ModelNotFoundException) {
            return response()->json(
                [
                    'error' =>
                        'You can only make this request if you have been invited to this event.',
                ],
                401
            );
        }
    }
}
