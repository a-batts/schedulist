<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function setColor(Request $request)
    {
        $validColors = Event::VALID_COLORS;
        $color = $request->color;

        $event = Event::find($request->id);
        if ($request->user() && $event->owner == $request->user()->id) {
            if (in_array($color, $validColors)) {
                $event->color = $color;
                $event->save();
                return response()->json(['success' => 'Color updated'], 200);
            }
            return response()->json(
                ['error' => 'An invalid color option was provided'],
                400
            );
        } else {
            return response()->json(
                [
                    'error' =>
                        'This request can only be made by the owner of the event',
                ],
                401
            );
        }
    }
}
