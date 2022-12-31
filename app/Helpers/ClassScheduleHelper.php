<?php

namespace App\Helpers;

use App\Models\Classes;
use App\Models\ClassSchedule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ClassScheduleHelper {

  /**
   * Collection of the user's schedules
   *
   * @var Collection<ClassSchedule>
   */
  private Collection $schedules;

  /**
   * Collection of the user's classes
   *
   * @var Collection<Classes>
   */
  private Collection $classes;

  public function __construct() {
    $this->schedules = Auth::User()->schedules;
    $this->classes = Auth::User()->classes;
  }

  /**
   * Get all of the classes for a given day
   *
   * @param Carbon $date
   * @return array
   */
  public function getDayClasses(Carbon $date): array {
    $day = [];

    $date = $date->copy()->startOfDay();
    $activeSchedule = $this->getActiveSchedule($date);

    if ($activeSchedule == null)
      return $day;

    foreach ($activeSchedule->times as $instance) {
      if ($instance->day_of_week == $date->dayOfWeekIso) {
        $startTime = explode(':', $instance->start_time);
        $endTime = explode(':', $instance->end_time);

        $day[] = [
          'start' => $date->copy()->setTime($startTime[0], $startTime[1]),
          'end' => $date->copy()->setTime($endTime[0], $endTime[1]),
          'class' => $this->classes->find($instance->class_id),
        ];
      }
    }

    usort(
      $day,
      fn ($a, $b) => $a['start']->timestamp <=> $b['start']->timestamp
    );

    return $day;
  }

  /**
   * Return the first class for a specific day, or null if there is no classes on that date
   *
   * @param Carbon $date
   * @return array|null
   */
  public function getFirstClass(Carbon $date): ?array {
    $classes = $this->getDayClasses($date);

    return isset($classes[0]) ? $classes[0] : null;
  }

  /**
   * Return the current class, or null if no class is occurring
   *
   * @param Carbon $dateTime
   * @return array|null
   */
  public function getCurrentClass(Carbon $dateTime): ?array {
    $classes = $this->getDayClasses($dateTime->copy());

    foreach ($classes as $class) {
      if ($class['start'] <= $dateTime && $class['end'] >= $dateTime)
        return $class;
    }

    return null;
  }

  /**
   * Get the next class after a provided datetime
   *
   * @param Carbon $dateTime
   * @return array|null
   */
  public function getNextClass(Carbon $dateTime): ?array {
    $classes = $this->getDayClasses($dateTime);

    $activeSchedule = $this->getActiveSchedule($dateTime);
    if ($activeSchedule == null || $dateTime->copy()->endOfDay() > Carbon::parse($activeSchedule->end_date)->endOfDay())
      return null;

    foreach ($classes as $class) {
      if ($class['start'] > $dateTime)
        return $class;
    }

    //If there are no more classes for the day, check the next day (recursive)
    return $this->getNextClass($dateTime->addDay()->startOfDay());
  }

  /**
   * Return the active schedule for a provided date
   *
   * @param Carbon $date
   * @return ClassSchedule|null
   */
  public function getActiveSchedule(Carbon $date): ?ClassSchedule {
    return $this->schedules->first(function (ClassSchedule $item) use ($date) {
      return ($date >= Carbon::parse($item->start_date)->startOfDay() && $date <= Carbon::parse($item->end_date)->endOfDay());
    });
  }
}
