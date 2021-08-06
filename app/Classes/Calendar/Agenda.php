<?php

namespace App\Classes\Calendar;

use App\Classes\Calendar\Event;

use App\Models\Assignment;
use App\Models\Classes;
use App\Models\ClassTime;
use App\Models\Event as EventModal;
use App\Models\Subscription;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\CarbonInterval;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

/**
 * Holds month of Events
 */
class Agenda{

    public array $agenda = [];

    protected $userSchedule;

    protected $assignments;
    protected $classes;
    protected $subscribed;

    /**
     * Scale factor of calender entries
     * @var int
     */
    private int $scaleFactor = 60;

    public function __construct(CarbonPeriod $dateRange){
        $this->assignments = Assignment::where('userid', Auth::User()->id)->where('due', '>=', $dateRange->getStartDate())->where('due', '<=', $dateRange->getEndDate())->get();
        $this->classes = Classes::where('userid', Auth::User()->id)->get();
        $this->getSubscriptions();
        $this->userSchedule = ClassTime::firstOrNew(['id' => Auth::User()->schedule_id], ['id' => Auth::User()->schedule_id]);
        $this->userSchedule->save();
        $this->userSchedule = $this->userSchedule->toArray();

        for ($i = 1; $i <= 31; $i++){
          $this->agenda[$i] = [];
        }
        foreach ($dateRange as $date){
          $this->agenda[$date->day] = $this->getDay($date);
        }

    }

    public function getDay(Carbon $date){
        $events = $this->getDayAssignments($date);
        $events = array_merge($events, $this->getDayClasses($date));
        $events = array_merge($events, $this->getDayEvents($date));

        usort($events, function($a, $b) {
          return $a->eventData['top'] <=> $b->eventData['top'];
        });
        for($i = 1; $i < count($events); $i++){
          if($events[$i]->eventData['top'] > $events[$i-1]->eventData['top'] && $events[$i]->eventData['top'] < $events[$i-1]->eventData['bottom']){
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
    public function getDayAssignments(Carbon $date){
      $assignments = $this->assignments;
      $agenda = [];
      foreach($assignments as $assignment) {
        if(Carbon::parse($assignment->due)->toDateString() == $date->toDateString()){
          $start = Carbon::parse($assignment->due);
          $top = Carbon::parse($assignment->due)->subHour()->subMinutes(1);

          if ($assignment->assignment_link != null)
            $link = Crypt::decryptString($assignment->assignment_link);

          $className = $this->classes->find($assignment->classid)->name;

          $event = new Event([
            'id' => $assignment->id,
            'start' => 'Due at '.$start->format('g:i A'),
            'end' => null,
            'timestring' => 'Due '.$start->format('g:i A'),
            'type' => 'Assignment',
            'title' => Crypt::decryptString($assignment->assignment_name),
            'top' => CarbonInterval::minutes($top->format('i'))->hours($top->format('G'))->totalSeconds / $this->scaleFactor,
            'bottom' => CarbonInterval::minutes($start->format('i'))->hours($start->format('G'))->totalSeconds / $this->scaleFactor,
            'left' => 0,
            'link' => route('assignmentPage').'/'.$assignment->url_string,
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
    public function getDayClasses(Carbon $date){
      $agenda = [];
      $classes = $this->classes;
      $userSchedule = $this->userSchedule;

      if ($date < Carbon::parse(Auth::User()->year_start_date) || $date >= Carbon::parse(Auth::User()->year_end_date))
        return $agenda;

      if ($userSchedule['schedule_type'] == "fixed" || $userSchedule['schedule_type'] == "normal"){
        $todayClasses = $userSchedule[$date->format('l')];
        $todayClasses = explode(',', $todayClasses);
        $startTimes = explode(',', $userSchedule['fixed_start_times']);
        $endTimes = explode(',', $userSchedule['fixed_end_times']);

        foreach ($classes as $class) {
          if (in_array($class->period, $todayClasses)){
            $start = $startTimes[$class->period - 1];
            $end = $endTimes[$class->period - 1];
            if (strlen($start) == 3)
              $start = '0'.$start;
            if (strlen($end) == 3)
              $end = '0'.$end;

            $start = Carbon::createFromFormat('Hi', $start);
            $end = Carbon::createFromFormat('Hi', $end);

            $event = new Event([
              'start' => $start->format('g:i'),
              'end' => $end->format('g:i A'),
              'timestring' => $start->format('g:i').' - '.$end->format('g:i A'),
              'type' => 'Class',
              'title' => $class->name,
              'top' => CarbonInterval::minutes($start->format('i'))->hours($start->format('G'))->totalSeconds / $this->scaleFactor,
              'bottom' => CarbonInterval::minutes($end->format('i'))->hours($end->format('G'))->totalSeconds / $this->scaleFactor,
              'left' => 0,
              'height' => 1,
              'color' => 'red',
            ], $date);

            array_push($agenda, $event);
          }
        }
      }
      elseif ($userSchedule['schedule_type'] == "block"){
        $range = CarbonPeriod::create($userSchedule['starting_date'], $date->toDateString());
        $count = $userSchedule['starting_block'] - 1;
        foreach ($range as $date){
          if(! $date->isWeekend())
            $count++;
        }
        $currentBlock = $count%$userSchedule['number_of_blocks'];
        if ($currentBlock == 0)
          $currentBlock = $userSchedule['number_of_blocks'];
        $todayClasses = $userSchedule['block'.$currentBlock];
        $todayClasses = explode(',', $todayClasses);
        $startTimes = explode(',', $userSchedule['block'.$currentBlock.'_start']);
        $endTimes = explode(',', $userSchedule['block'.$currentBlock.'_end']);

        $classes = Classes::where('userid', Auth::User()->id)->get();
        foreach ($classes as $class) {
          if (in_array($class->period, $todayClasses)){
            $index = array_search($class->period, $todayClasses);
            $start = $startTimes[$index];
            $end = $endTimes[$index];
            if (strlen($start) == 3)
              $start = '0'.$start;
            if (strlen($end) == 3)
              $end = '0'.$end;

            $start = Carbon::createFromFormat('Hi', $start);
            $end = Carbon::createFromFormat('Hi', $end);

            $event = new Event([
              'start' => $start->format('g:i'),
              'end' => $end->format('g:i A'),
              'timestring' => $start->format('g:i').' - '.$end->format('g:i A'),
              'type' => 'Class',
              'title' => $class->name,
              'top' => CarbonInterval::minutes($start->format('i'))->hours($start->format('G'))->totalSeconds / $this->scaleFactor,
              'bottom' => CarbonInterval::minutes($end->format('i'))->hours($end->format('G'))->totalSeconds / $this->scaleFactor,
              'left' => 0,
              'height' => 1,
              'color' => 'red',
            ], $date);

            array_push($agenda, $event);
          }
        }

      }
      return $agenda;
    }

    public function getDayEvents(Carbon $date){
      $agenda = [];
      $dayIso = $date->dayOfWeekIso;
      $startOfWeek = $date->copy()->startOfWeek()->toDateString();
      $endOfWeek = $date->copy()->endOfWeek()->toDateString();

      $events = EventModal::where('date', '<=', $date->toDateString())
      ->where(fn($query) =>
        $query->where('user_id', Auth::user()->id)
        ->orWhereIn('id', explode(',', $this->subscribed->events))
        )
      ->where(fn($query) =>
        $query->whereDate('date', $date->toDateString())
        ->orWhere(fn($query) =>
          $query->where('reoccuring', true)
          ->where(fn($query) =>
            $query->where('frequency', 'Day')
            ->orWhere(['frequency' => 'Week', ['days', 'like', '%'.$dayIso.'%']])
            ->orWhere(['frequency' => 'Month', ['date', 'like', '%-'.$date->format('d')]])
            ->orWhere(fn($query) =>
              $query->where('frequency', 'Two Weeks')
              ->where(fn($query) =>
                $query->whereRaw("DATEDIFF('".$date->toDateString()."', date) % 14 = 0")
                ->orWhere(fn($query) =>
                 $query->where('days', 'like', '%'.$dayIso.'%')
                 ->whereRaw("DATEDIFF('".$startOfWeek."', date) % 14 > 7")
                )
                ->orWhere(fn($query) =>
                  $query->where('days', 'like', '%'.$dayIso.'%')
                  ->whereRaw("DATEDIFF('".$startOfWeek."', date) < 7")
                  ->whereRaw("DATEDIFF(date, '".$endOfWeek."') > -7")
                )
              )
            )
          )
        )
      )->get();

      foreach($events as $each){
        if (isset($each->frequency))
          $each->frequency = 'Every '.$each->frequency;

        $start = Carbon::parse($each->start_time);
        $end = Carbon::parse($each->end_time);
        $event = new Event([
          'id' => $each->id,
          'start' => $start->format('g:i'),
          'end' => $end->format('g:i A'),
          'timestring' => $start->format('g:i').' - '.$end->format('g:i A'),
          'type' => 'Event',
          'repeat' => 'Repeats '.($each->frequency ?? 'Never'),
          'title' => $each->name,
          'top' => CarbonInterval::minutes($start->format('i'))->hours($start->format('G'))->totalSeconds / $this->scaleFactor,
          'bottom' => CarbonInterval::minutes($end->format('i'))->hours($end->format('G'))->totalSeconds / $this->scaleFactor,
          'left' => 0,
          'category' => $each->category,
          'height' => 1,
          'color' => ''.($each->color ?? 'blue'),
          'isOwner' => (Auth::User()->id == $each->user_id),
        ], $date);
        array_push($agenda, $event);
      }
      return $agenda;
    }

    public function getSize(){
        return count($this->agenda);
    }

    public function getSubscriptions(){
      $this->subscribed = Subscription::firstOrNew(['user_id' => Auth::User()->id], ['user_id' => Auth::User()->id]);
      $this->subscribed->save();
    }

    public function toArray(){
        $agenda = $this->agenda;
        for ($i = 1; $i <= 31; $i++){
          foreach($agenda[$i] as $key => $event)
            $agenda[$i][$key] = $event->toArray();
        }
        return $agenda;
    }
}
