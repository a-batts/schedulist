<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Events;
use App\Models\Classes;
use App\Models\ClassSchedule;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class ClassCard extends Component
{
    public $currentTime;
    public $currentDay;
    public $currentClass;
    public $currentBlock;
    public $scheduleType;
    public bool $userHasClasses = false;
    public bool $userHasSchedule = true;
    public bool $schoolYearInSession = true;

    public $event = [];

    public bool $schedulePicker = false;
    protected $listeners = ['refreshClasses'];

    /**
     * Grab the class array for the current class
     *
     * @return mixed
     */
    public function getSchedule(){
      $this->currentTime = Carbon::now()->format('Hi');

      if(ClassSchedule::where('id', Auth::User()->schedule_id)->first() != null && Auth::User()->schedule_id != null){
        $usersSchedule = ClassSchedule::where('id', Auth::User()->schedule_id)->first()->toArray();
        $this->scheduleType = $usersSchedule['schedule_type'];
      }
      else{
        $this->userHasSchedule = false;
        return 'No schedule';
      }
      //Handle summer/seasonal break
      if(isset(Auth::User()->year_start_date) && isset(Auth::User()->year_end_date)){
        if(Carbon::now() < Auth::User()->year_start_date || Carbon::now() > Auth::User()->year_end_date){
          $this->schoolYearInSession = false;
          return 'No school';
        }
      }

      //Handle events before checking for currently active class
      if (Events::whereDate('date', Carbon::now()->toDateString())->exists()){
        $events = Events::whereDate('date', Carbon::now()->toDateString())->where('schedule', Auth::User()->schedule_id)->orWhere('schedule', 'all')->where('priority', 0)->first();
        if($events == null)
          $events = Events::whereDate('date', Carbon::now()->toDateString())->where('schedule', Auth::User()->schedule_id)->orWhere('schedule', 'all')->where('priority', '>', 0)->first();

        $this->event['title'] = $events->title;
        $this->event['description'] = $events->description;

        return "event";
      }

      if ($usersSchedule['schedule_type'] == "fixed" || $usersSchedule['schedule_type'] == "normal"){
        $this->currentDay = Carbon::now()->format('l');

        if($usersSchedule[$this->currentDay] == "null")
          return "off";
        if($usersSchedule[$this->currentDay] == "async")
          return "async";

        $startTimes = explode(",", $usersSchedule['fixed_start_times']);
        $endTimes = explode(",", $usersSchedule['fixed_end_times']);
        $todayClasses = explode(",", $usersSchedule[$this->currentDay]);
        return $this->findCurrentClass($startTimes, $endTimes, $todayClasses);
      }
      elseif ($usersSchedule['schedule_type'] == "block"){
        if (Carbon::now()->isWeekend()){
          $this->currentBlock = "off";
          return "off";
        }
        $range = CarbonPeriod::create($usersSchedule['starting_date'], Carbon::now()->toDateString());
        $count = $usersSchedule['starting_block'] - 1;
        foreach ($range as $date){
          if(! $date->isWeekend())
            $count++;
        }
        $currentBlock = $count%$usersSchedule['number_of_blocks'];
        if ($currentBlock == 0)
          $currentBlock = $usersSchedule['number_of_blocks'];

        $this->currentBlock = $currentBlock;

        if($usersSchedule['block'.$currentBlock] == "null")
          return "off";
        if($usersSchedule['block'.$currentBlock] == "async")
          return "async";

        $startTimes = explode(",", $usersSchedule['block'.$currentBlock.'_start']);
        $endTimes = explode(",", $usersSchedule['block'.$currentBlock.'_end']);
        $todayClasses = explode(",", $usersSchedule['block'.$currentBlock]);
        return $this->findCurrentClass($startTimes, $endTimes, $todayClasses);
      }
    }

    /**
     * Find the current class user should be in
     * @param  array $startArray
     * @param  array $endArray
     * @param  array $classArray
     * @return mixed
     */
    public function findCurrentClass($startArray, $endArray, $classArray){
      $currentTime = $this->currentTime;
      $numberPeriods = count($startArray);

      for ($i=1; $i <= $numberPeriods; $i++) {
        if($startArray[$i-1] != null && $endArray[$i-1] != null && $currentTime + 2 >= $startArray[$i-1] && $currentTime - 2 <= $endArray[$i-1]){
          if($this->scheduleType == "fixed" || $this->scheduleType == "normal"){
            if (in_array($i, $classArray))
              return Classes::where('userid', Auth::user()->id)->where('period', $i)->first();
            return Classes::where('userid', Auth::user()->id)->where('period', $i+1)->first();
          }
          return Classes::where('userid', Auth::user()->id)->where('period', $classArray[$i-1])->first();
        }

      }
      return null;
    }

    /**
     * Refresh function for wire:poll
     * @return void
     */
    public function refreshClasses(){
      if (Auth::User()->schedule_id == null){
        $this->userHasSchedule = false;
        if ($this->getNumberClasses() > 0)
          $this->userHasClasses = true;
        else
          $this->userHasClasses = false;
      }
      elseif ($this->getNumberClasses() > 0){
        $this->userHasClasses = true;
        $this->currentClass = $this->getSchedule();
      }
      else{
        $this->userHasClasses = false;
        $this->currentClass = null;
      }

    }

    /**
     * Return the number of user's classes
     * @return void
     */
    public function getNumberClasses(){
      return Classes::where('userid', Auth::user()->id)->count();
    }

    /**
     * Grab user's classes
     *
     * @return \App\Models\Classes
     */
    public function getClasses(){
      return Classes::where('userid', Auth::user()->id)->orderBy('period', 'asc')->get();
    }

    public function render(){
        $classes = $this->getClasses();
        $this->refreshClasses();
        return view('livewire.dashboard.class-card')->with('classes', $classes);
    }
}
