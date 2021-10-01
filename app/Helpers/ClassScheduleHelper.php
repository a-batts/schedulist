<?php

namespace App\Helpers;

use App\Models\Classes;
use App\Models\ClassSchedule;
use App\Models\User;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

use Illuminate\Support\Facades\Auth;

class ClassScheduleHelper {

  private Carbon $dt;

  public function __construct(Carbon $dateTime) {
    $this->dt = $dateTime;
  }

  /**
   * Returns the active class for the given user and datetime
   * @return Classes|bool object of active class, false if none exists
   */
  public function getActiveClass() {
    $classSchedule = Auth::User()->classSchedule->first();
    if ($classSchedule == null || !$this->termInProgress($this->dt))
      return false;
    $classSchedule = $classSchedule->toArray();

    $daySchedule = $this->getDaySchedule($classSchedule, $this->dt);

    if (!isset($daySchedule) || $daySchedule == 'async')
      return false;
    $daySchedule = explode('|', $daySchedule);
    $classes = explode(',', $daySchedule[0]);
    $times = explode(',', $daySchedule[1]);

    return $this->searchForActiveClass($classes, $times, $this->dt);
  }

  /**
   * Get schedule for the provided day
   * @param  ClassSchedule $classSchedule
   * @param  Carbon $dt
   * @return string
   */
  public function getDaySchedule($classSchedule, Carbon $dt = null) {
    if ($dt == null) $dt = $this->dt;

    if (!$this->termInProgress($dt))
      return '|';

    if ($classSchedule['schedule_type'] == 'fixed' || $classSchedule['schedule_type'] == 'custom') {
      $dayOfWeek = $dt->format('N');
      $daySchedule = $classSchedule['block_' . $dayOfWeek];
    } else if ($classSchedule['schedule_type'] == 'block') {
      if ($dt->isWeekend())
        return '|';
      $range = CarbonPeriod::create(Carbon::parse($classSchedule['schedule_start']), $dt);
      $count = $classSchedule['start_block'] - 1;
      foreach ($range as $i) {
        if (!$i->isWeekend())
          $count++;
      }
      $currentBlock = $count % ($classSchedule['number_blocks']);

      $daySchedule = $classSchedule['block_' . ($currentBlock + 1)];
    }
    return $daySchedule;
  }

  public function getFirstClass(Carbon $dt) {
    $classSchedule = Auth::User()->classSchedule->first();
    if ($classSchedule == null || !$this->termInProgress($dt))
      return false;
    $classSchedule = $classSchedule->toArray();

    $daySchedule = $this->getDaySchedule($classSchedule, $dt);
    $daySchedule = explode('|', $daySchedule);
    $classes = explode(',', $daySchedule[0]);

    if (!isset($daySchedule) || $daySchedule == 'async')
      return $this->getFirstClass($dt->addDay());

    $class = Classes::find($classes[0]);
    if ($class == null)
      return $this->getFirstClass($dt->addDay());
    return [
      'class' => $class,
      'day' => $dt->format('D, F jS')
    ];
  }

  /**
   * Get the next class after a specified class for the provided date
   * @param  Carbon $dt
   * @param  int|null $currentClassId [optional]
   * class from provided date to search after
   * @return array|False             Returns array of next class or false if none exists
   */
  public function getNextClass(Carbon $dt, $currentClassId = null) {
    $classSchedule = Auth::User()->classSchedule->first();
    if ($classSchedule == null || !$this->termInProgress($dt))
      return false;

    $classSchedule = $classSchedule->toArray();

    $daySchedule = $this->getDaySchedule($classSchedule, $dt);

    if (!isset($daySchedule) || $daySchedule == 'async')
      return $this->getFirstClass($dt->addDay());
    $daySchedule = explode('|', $daySchedule);
    $classes = explode(',', $daySchedule[0]);
    $times = explode(',', $daySchedule[1]);

    if (isset($currentClassId)) {
      $classIndex = array_search($currentClassId, $classes);
      if (!isset($classes[$classIndex + 1]))
        return $this->getFirstClass($dt->addDay());
      $classIndex++;
      $i = $classIndex * 2;
    } else {
      for ($i = 0; $i < count($times); $i += 2) {
        if ($times[$i] > $dt->format('Hi')) {
          $classIndex = $i / 2;
          break;
        }
      }
      if (!isset($classIndex))
        return $this->getFirstClass($dt->addDay());
    }
    $class = Classes::find($classes[$classIndex]);
    $class->startTime = $times[$i];
    $class->endTime = $times[$i + 1];
    return [
      'class' => $class,
      'day' => $dt->format('D, F jS')
    ];
  }

  /**
   * Search class and time arrays to find active class
   * @param  array  $classes
   * @param  array  $times
   * @param  Carbon $dt
   * @return Classes|null active class object or null
   */
  public function searchForActiveClass($classes, $times, Carbon $dt) {
    if (count($times) < 2)
      return null;
    $currentTime = $dt->format('Hi');
    for ($i = 1; $i <= count($times); $i += 2) {
      if ($currentTime + 2 >= $times[$i - 1] && $currentTime - 2 <= $times[$i]) {
        $classIndex = $i / 2;
        $class = Classes::find($classes[$classIndex]);
        $class->startTime = $times[$i - 1];
        $class->endTime = $times[$i];
        return $class;
      }
    }
    return null;
  }

  /**
   * Checks if term is currently in progress for user
   * @param  Carbon  $dateTime
   * @return bool
   */
  public function termInProgress($dateTime = null) {
    if ($dateTime == null) $dateTime = $this->dt;

    if (Auth::User()->classSchedule()->first() == null)
      return false;

    $user = Auth::User();
    $startTerm = Carbon::parse($user->year_start_date);
    $endTerm = Carbon::parse($user->year_end_date);

    if ($dateTime >= $startTerm && $dateTime <= $endTerm && $dateTime >= Carbon::parse(Auth::user()->classSchedule->first()->schedule_start)->setHours(0)->setMinutes(0)->toDateString())
      return true;
    return false;
  }
}
