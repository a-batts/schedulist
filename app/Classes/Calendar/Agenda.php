<?php

namespace App\Classes\Calendar;

use App\Classes\Calendar\Event;

use App\Helpers\ClassScheduleHelper;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\CarbonInterval;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

/**
 * Holds month of Events
 */
class Agenda {

  public array $agenda = [];

  protected $userSchedule;

  protected $assignments;
  protected $classes;
  protected $events;

  /**
   * Scale factor of calender event items
   * @var int
   */
  const SCALE_FACTOR = 60;

  public function __construct(CarbonPeriod $dateRange) {
    $this->assignments = Auth::user()->assignments()->where('due', '>=', $dateRange->getStartDate())->where('due', '<=', $dateRange->getEndDate())->get();
    $this->classes = Auth::user()->classes()->get();
    $this->events = Auth::user()->events()->get();
    $this->userSchedule = Auth::user()->classSchedule()->first();
    if ($this->userSchedule != null)
      $this->userSchedule = $this->userSchedule->toArray();

    for ($i = 1; $i <= 31; $i++) {
      $this->agenda[$i] = [];
    }
    foreach ($dateRange as $date) {
      $this->agenda[$date->day] = $this->getDay($date);
    }
  }

  public function getDay(Carbon $date) {
    $events = $this->getDayAssignments($date);
    $events = array_merge($events, $this->getDayClasses($date));
    $events = array_merge($events, $this->getDayEvents($date));

    usort($events, function ($a, $b) {
      return $a->eventData['top'] <=> $b->eventData['top'];
    });
    for ($i = 1; $i < count($events); $i++) {
      if ($events[$i]->eventData['top'] > $events[$i - 1]->eventData['top'] && $events[$i]->eventData['top'] < $events[$i - 1]->eventData['bottom']) {
        $events[$i]->eventData['left'] = $events[$i - 1]->eventData['left'] + 140;
        $events[$i]->eventData['height'] = $events[$i - 1]->eventData['height'] + 1;
      };
    }
    return $events;
  }

  /**
   * Return assignments for a specified Carbon date
   * @param Carbon $date
   * @return array
   */
  public function getDayAssignments(Carbon $date) {
    $assignments = $this->assignments;
    $agenda = [];
    foreach ($assignments as $assignment) {
      if (Carbon::parse($assignment->due)->toDateString() == $date->toDateString()) {
        $start = Carbon::parse($assignment->due);
        $top = Carbon::parse($assignment->due)->subHour()->subMinutes(1);

        if ($assignment->assignment_link != null)
          $link = Crypt::decryptString($assignment->assignment_link);

        if ($this->classes->find($assignment->classid) != null)
          $className = $this->classes->find($assignment->classid)->name;
        else
          $className = 'Deleted Class';

        $event = new Event([
          'id' => $assignment->id,
          'start' => 'Due at ' . $start->format('g:i A'),
          'end' => null,
          'timestring' => 'Due ' . $start->format('g:i A'),
          'type' => 'Assignment',
          'title' => Crypt::decryptString($assignment->assignment_name),
          'top' => CarbonInterval::minutes($top->format('i'))->hours($top->format('G'))->totalSeconds / self::SCALE_FACTOR,
          'bottom' => CarbonInterval::minutes($start->format('i'))->hours($start->format('G'))->totalSeconds / self::SCALE_FACTOR,
          'left' => 0,
          'link' => route('assignmentPage') . '/' . $assignment->url_string,
          'className' => $className,
          'url' => $link ?? null,
          'height' => 1,
          'color' => 'green',
        ], $date);

        array_push($agenda, $event);
      }
    }
    return $agenda;
  }

  /**
   * Return classes for a specified Carbon date
   * @param Carbon $date
   * @return array
   */
  public function getDayClasses(Carbon $date) {
    $agenda = [];

    $scheduleHelper = new ClassScheduleHelper($date);
    if (!$scheduleHelper->termInProgress())
      return $agenda;
    $daySchedule = $scheduleHelper->getDaySchedule($this->userSchedule);

    if (!isset($daySchedule) || $daySchedule == 'async')
      return $agenda;
    $daySchedule = explode('|', $daySchedule);
    if (count($daySchedule) < 2)
      return $agenda;
    $classes = explode(',', $daySchedule[0]);
    $times = explode(',', $daySchedule[1]);

    foreach ($this->classes as $class) {
      if (in_array($class->id, $classes)) {
        $index = array_search($class->id, $classes);
        $start = $times[$index * 2];
        $end = $times[$index * 2 + 1];
        if (strlen($start) == 3)
          $start = '0' . $start;
        if (strlen($end) == 3)
          $end = '0' . $end;

        $start = Carbon::createFromFormat('Hi', $start);
        $end = Carbon::createFromFormat('Hi', $end);

        $event = new Event([
          'start' => $start->format('g:i'),
          'end' => $end->format('g:i A'),
          'timestring' => $start->format('g:i') . ' - ' . $end->format('g:i A'),
          'type' => 'Class',
          'title' => $class->name,
          'top' => CarbonInterval::minutes($start->format('i'))->hours($start->format('G'))->totalSeconds / self::SCALE_FACTOR,
          'bottom' => CarbonInterval::minutes($end->format('i'))->hours($end->format('G'))->totalSeconds / self::SCALE_FACTOR,
          'left' => 0,
          'height' => 1,
          'color' => 'red',
        ], $date);
        array_push($agenda, $event);
      }
    }
    return $agenda;
  }

  public function getDayEvents(Carbon $date) {
    $agenda = [];
    $dayIso = $date->dayOfWeekIso;

    foreach ($this->events as $each) {
      $eventDate = Carbon::parse($each->date);
      if ($each->reoccuring)
        $days = explode(',', (string) $each->days);

      $eventIsToday = ($eventDate->toDateString() == $date->toDateString());
      if ($each->frequency == 31)
        $repeatsToday = ($eventDate > $date && Carbon::now()->setDay($eventDate->format('j'))->between($date->copy()->startOfWeek(), $date->copy()->endOfWeek()) && in_array($dayIso, $days));
      else if ($each->frequency != null)
        $repeatsToday = (($eventDate->diffInDays($date) % $each->frequency == 0 || $eventDate->diffInDays($date) % $each->frequency < 7 && $eventDate->diffInDays($date) % $each->frequency > -7) && in_array($dayIso, $days));
      else
        $repeatsToday = false;

      if ($eventIsToday || ($each->reoccuring && $repeatsToday)) {
        if (isset($each->frequency)) {
          if ($each->frequency == 31)
            $frequency = 'Every Month';
          else
            $frequency = 'Every ' . $each->frequency . ' Days';
        }

        $start = Carbon::parse($each->start_time);
        $end = Carbon::parse($each->end_time);
        $event = new Event([
          'id' => $each->id,
          'start' => $start->format('g:i'),
          'end' => $end->format('g:i A'),
          'timestring' => $start->format('g:i') . ' - ' . $end->format('g:i A'),
          'type' => 'Event',
          'repeat' => 'Repeats ' . ($frequency ?? 'Never'),
          'title' => Crypt::decryptString($each->name),
          'top' => CarbonInterval::minutes($start->format('i'))->hours($start->format('G'))->totalSeconds / self::SCALE_FACTOR,
          'bottom' => CarbonInterval::minutes($end->format('i'))->hours($end->format('G'))->totalSeconds / self::SCALE_FACTOR,
          'left' => 0,
          'category' => $each->category,
          'height' => 1,
          'color' => '' . ($each->color ?? 'blue'),
          'isOwner' => (Auth::User()->id == $each->owner),
        ], $date);
        array_push($agenda, $event);
      }
    }
    return $agenda;
  }

  public function getSize() {
    return count($this->agenda);
  }

  public function toArray() {
    $agenda = $this->agenda;
    for ($i = 1; $i <= 31; $i++) {
      foreach ($agenda[$i] as $key => $event)
        $agenda[$i][$key] = $event->toArray();
    }
    return $agenda;
  }
}
