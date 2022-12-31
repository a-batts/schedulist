<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\ClassSchedule;
use App\Models\ClassTime;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClassController extends Controller {

    private array $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

    /**
     * Change the schedule a class is attached to
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function setSchedule(Request $request): JsonResponse {
        $class = Classes::find($request->class);
        $schedule = ClassSchedule::find($request->schedule);

        if ($request->user() && $class->user_id == $request->user()->id && $schedule->user_id == $request->user()->id) {
            $class->schedule_id = $schedule->id;
            $class->save();

            foreach ($class->times as $time) {
                $time->schedule_id = $schedule->id;
                $time->save();
            }

            return response()->json(['success', 'Schedule updated'], 200);
        } else {
            return response()->json(['error' => 'This request can only be made by the owner of the class/schedule'], 401);
        }
    }

    /**
     * Add a scheduled occurance for a class
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addClassTime(Request $request): JsonResponse {
        $class = Classes::find($request->class);
        if ($request->user() && $class->user_id == $request->user()->id) {
            $day = array_search($request->day, $this->days);

            if ($day === false)
                return response()->json(['error' => 'Invalid day provided'], 400);

            $start = explode(':', $request->start);
            $end = explode(':', $request->end);

            $start = Carbon::now()->setHours($start[0])->setMinutes($start[1]);
            $end = Carbon::now()->setHours($end[0])->setMinutes($end[1]);

            $schedule = $class->schedule;

            foreach ($schedule->times as $time) {
                if ($day == $time->day_of_week && $time->class_id == $class->id)
                    return response()->json(['error' => 'Cannot have a class twice on the same day'], 400);
            }

            $newTime = $class->times()->create([
                'schedule_id' => $class->schedule_id,
                'start_time' => $start->format('G:i'),
                'end_time' => $end->format('G:i'),
                'day_of_week' => $day,
            ]);

            return response()->json(['success' => 'Time added', 'data' => json_encode($newTime)], 200);
        }

        return response()->json(['error' => 'This request can only be made by the owner of the class'], 401);
    }

    /**
     * Remove a scheduled occurance for a class
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function removeClassTime(Request $request): JsonResponse {
        $classTime = ClassTime::find($request->id);
        $class = Classes::find($classTime->class_id);

        if ($request->user() && $class->user_id == $request->user()->id) {
            $classTime->delete();
            return response()->json(['success', 'Class time removed'], 200);
        }
        return response()->json(['error' => 'This request can only be made by the owner of the class'], 401);
    }
}
