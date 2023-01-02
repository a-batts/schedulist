<?php

namespace App\Classes\Schedule;

use App\Helpers\ClassScheduleHelper;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;

class Schedule {

    /**
     * Scale factor of individual schedule item, used to properly render on the front end
     */
    const SCALE_FACTOR = 60;

    /**
     * Get the schedule for a single day
     *
     * @param Carbon $date
     * @return Day
     */
    public static function getSingleDay(Carbon $date): Day {
        $scheduleHelper = new ClassScheduleHelper;

        $queriedData = [
            'assignments' => Auth::user()->assignments()->where('due', $date)->get(),
            'classes' => Auth::user()->classes()->get(),
            'events' => Auth::user()->events()->get(),
            'schedule' => $scheduleHelper,
        ];

        return new Day($date, $queriedData);
    }

    /**
     * Get the schedule for a single month (in the form of a CarbonPeriod range)
     *
     * @param CarbonPeriod $dateRange
     * @return Month
     */
    public static function getSingleMonth(CarbonPeriod $dateRange): Month {
        return new Month($dateRange);
    }
}
