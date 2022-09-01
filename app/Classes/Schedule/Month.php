<?php

namespace App\Classes\Schedule;

use App\Helpers\ClassScheduleHelper;
use BaconQrCode\Exception\OutOfBoundsException;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;

class Month {
    private CarbonPeriod $dateRange;

    private int $length;

    /**
     *
     * @var array<Day>
     */
    private array $days = [];

    public function __construct(CarbonPeriod $dateRange) {
        $this->dateRange = $dateRange;
        $this->length = $dateRange->count();

        $scheduleHelper = new ClassScheduleHelper;

        $queriedData = [
            'assignments' => Auth::user()->assignments()->where('due', '>=', $dateRange->getStartDate())->where('due', '<=', $dateRange->getEndDate())->get(),
            'classes' => Auth::user()->classes()->get(),
            'events' => Auth::user()->events()->get(),
            'schedule' => $scheduleHelper,
        ];

        //Create a new Day object for each day of the month
        foreach ($dateRange as $date)
            $this->days[$date->day] = new Day($date, $queriedData);
    }

    /**
     * Get the corresponding Day object for a specified date
     *
     * @param Carbon|integer $date
     * @return Day
     */
    public function getDay($date): Day {
        if ($date instanceof Carbon) {
            $day = $date->day;

            if (isset($days[$day]))
                return $this->days[$day];
        } else {
            if ($date > 0 && $date <= $this->length)
                return $this->days[$date];
        }

        throw new OutOfBoundsException;
    }

    /**
     * Get the CarbonPeriod date range
     *
     * @return CarbonPeriod
     */
    public function getDateRange(): CarbonPeriod {
        return $this->dateRange;
    }

    /**
     * Get the array representation of the month
     *
     * @return array
     */
    public function toArray(): array {
        $arr = [];

        for ($i = 1; $i <= $this->length; $i++)
            $arr[$i] = $this->days[$i]->toArray();
        return $arr;
    }
}
