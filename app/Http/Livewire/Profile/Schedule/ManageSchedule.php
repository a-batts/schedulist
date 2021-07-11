<?php

namespace App\Http\Livewire\Profile\Schedule;

use App\Models\Classes;
use App\Models\ClassTime;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class ManageSchedule extends Component
{
    public $schedule;
    public $suggestions = [];
    public $selectedSchedule;
    public $query;
    public $schoolName;

    public bool $usingCustomSchedule = false;
    public bool $hasSchedule = false;
    public bool $startingNewSchedule = false;

    public $scheduleType;
    public $numberClasses = 0;
    public $numberOfBlockDays;
    public $startingBlock;
    public $blockStyle;

    public $oldCustomTimes = [];
    public $customTimes = [];

    public $customFixedDays = [
      "M" => [],
      "T" => [],
      "W" => [],
      "Th" => [],
      "F" => []
    ];

    public $customBlockDays = [
      "1" => [],
      "2" => [],
      "3" => [],
      "4" => [],
      "5" => []
    ];

    protected $listeners = ['refreshScheduleSettings' => '$refresh'];

    /**
     * Mount the component
     * @return void
     */
    public function mount(){
      $this->reset('oldCustomTimes');
      $this->reset('customTimes');
      $this->suggestions = ClassTime::whereNull('user_id')->where('type', 'like', '%' . $this->query . '%')->limit(5)->orderBy('type', 'asc')->get()->toArray();
      $this->schedule = ClassTime::where('id', Auth::user()->schedule_id)->first();
      if(isset(Auth::User()->schedule_id))
        $this->hasSchedule = true;
      $schedule = $this->schedule;
      if ($schedule == null)
        return;
      if($schedule->block_style != null)
        $this->blockStyle = $schedule->block_style;
      else
        $this->blockStyle = 'number';
      if($schedule != null && Auth::user()->schedule_id != null){
        if ($schedule->type == "user"){
          $this->usingCustomSchedule = true;
          $this->scheduleType = $schedule->schedule_type;
          $this->numberClasses = $schedule->number_of_classes;
          $this->numberOfBlockDays = $schedule->number_of_blocks;
          $this->startingBlock = $schedule->starting_block;
          if ($schedule->schedule_type == "normal" || $schedule->schedule_type == "fixed"){
            $this->customFixedDays['M'] = explode(',', $schedule->Monday);
            $this->customFixedDays['T'] = explode(',', $schedule->Tuesday);
            $this->customFixedDays['W'] = explode(',', $schedule->Wednesday);
            $this->customFixedDays['Th'] = explode(',', $schedule->Thursday);
            $this->customFixedDays['F'] = explode(',', $schedule->Friday);

            $startTimes = explode(',', $schedule->fixed_start_times);
            $endTimes = explode(',', $schedule->fixed_end_times);
            for ($i = 1; $i <= count($startTimes); $i++){
              if(strlen($startTimes[$i - 1]) == 3)
                $startTimes[$i - 1] = '0'.$startTimes[$i - 1];
              $this->customTimes['pd'.$i.'start'] = Carbon::createFromFormat('Hi', $startTimes[$i - 1])->format('g:i A');
              $this->oldCustomTimes['pd'.$i.'start'] = Carbon::createFromFormat('Hi', $startTimes[$i - 1])->format('g:i A');
              if(strlen($endTimes[$i - 1]) == 3)
                $endTimes[$i - 1] = '0'.$endTimes[$i - 1];
              $this->customTimes['pd'.$i.'end'] = Carbon::createFromFormat('Hi', $endTimes[$i - 1])->format('g:i A');
              $this->oldCustomTimes['pd'.$i.'end'] = Carbon::createFromFormat('Hi', $endTimes[$i - 1])->format('g:i A');
            }
          }
          elseif ($schedule->schedule_type == "block"){

            $this->customBlockDays['1'] = explode(',', $schedule->block1);
            $this->customBlockDays['2'] = explode(',', $schedule->block2);
            $this->customBlockDays['3'] = explode(',', $schedule->block3);
            $this->customBlockDays['4'] = explode(',', $schedule->block4);
            $this->customBlockDays['5'] = explode(',', $schedule->block5);

            $startTimes['1'] = explode(',', $schedule->block1_start);
            $startTimes['2'] = explode(',', $schedule->block2_start);
            $startTimes['3'] = explode(',', $schedule->block3_start);
            $startTimes['4'] = explode(',', $schedule->block4_start);
            $startTimes['5'] = explode(',', $schedule->block5_start);

            $endTimes['1'] = explode(',', $schedule->block1_end);
            $endTimes['2'] = explode(',', $schedule->block2_end);
            $endTimes['3'] = explode(',', $schedule->block3_end);
            $endTimes['4'] = explode(',', $schedule->block4_end);
            $endTimes['5'] = explode(',', $schedule->block5_end);

            for ($i = 1; $i <= 5; $i++){
              foreach ($this->customBlockDays[$i] as $key => $value) {
                if($startTimes[$i][$key] != null)
                  $this->customTimes['pd'.$value.'start'] = Carbon::createFromFormat('Hi', $startTimes[$i][$key])->format('g:i A');
                if($endTimes[$i][$key] != null)
                  $this->customTimes['pd'.$value.'end'] = Carbon::createFromFormat('Hi', $endTimes[$i][$key])->format('g:i A');
              }
            }
            $this->oldCustomTimes = $this->customTimes;
          }
        }
        else{
          $this->schoolName = $this->schedule->type;
          $this->query = $this->schedule->type." - ".$this->schedule->location;
          $this->selectedSchedule = $this->schedule->id;
        }
      }
    }

    /**
     * Run on component property update
     * @param  string $propertyName
     * @return void
     */
    public function updated($propertyName) {
        if(str_contains($propertyName, 'pd')){
          $updatedTimes = $this->fixTime($propertyName, $this->oldCustomTimes, $this->customTimes);
          $this->customTimes = $updatedTimes['new'];
          $this->oldCustomTimes = $updatedTimes ['old'];
        }
    }

    /**
     * Process time values on update to ensure they are properly formatted
     * @param  string $arrayName
     * @return array
     */
    public function fixTime($updatedTime, $oldArray, $newArray){
      $data = $newArray[substr($updatedTime, strpos($updatedTime, 'pd'))];

      if ($data == null){
        $newArray[substr($updatedTime, strpos($updatedTime, 'pd'))] = null;
        $oldArray[substr($updatedTime, strpos($updatedTime, 'pd'))] = null;
        return ["old" => $oldArray, "new" => $newArray];
      }
      if (strlen($data) == 1 && $data < 10 && is_numeric($data)){
        $data = $data.':00 '.Carbon::now()->format('A');
      }
      elseif (strlen($data) == 2 && $data < 13 && is_numeric($data)){
        $data = $data.':00 '.Carbon::now()->format('A');
      }
      elseif (strlen($data) == 2 && $data > 12 && $data < 24 && is_numeric($data)){
        $data -= 12;
        $data = $data.':00 PM';
      }
      elseif (strlen($data) == 2 && $data == 24 && is_numeric($data)){
        $data -= 12;
        $data = $data.':00 AM';
      }
      if (strpos($data, ':') == 2 && substr($data, 0, 2) > 12 && substr($data, 0, 2) < 24){
        $data = substr($data, 0, 2) % 12 .substr($data, 2, 4).' PM';
      }
      else if (strpos($data, ':') == 2 && substr($data, 0, 2) == 24){
        $data = '12:00 AM';
      }
      if( substr($data, 0, 2) > 24){
        if (! isset($oldArray[substr($updatedTime, strpos($updatedTime, 'pd'))]))
          $oldArray[substr($updatedTime, strpos($updatedTime, 'pd'))] = Carbon::now()->format('g:i A');
        $newArrays[substr($updatedTime, strpos($updatedTime, 'pd'))] = $oldArray[substr($updatedTime, strpos($updatedTime, 'pd'))];

        return ["old" => $oldArray, "new" => $newArray];
      }
      if (substr($data, strpos($data, ':') + 1) > 60){
        if (! isset($oldArray[substr($updatedTime, strpos($updatedTime, 'pd'))]))
          $oldArray[substr($updatedTime, strpos($updatedTime, 'pd'))] = Carbon::now()->format('g:i A');
        $newArray[substr($updatedTime, strpos($updatedTime, 'pd'))] = $oldArray[substr($updatedTime, strpos($updatedTime, 'pd'))];

        return ["old" => $oldArray, "new" => $newArray];
      }
      if (! str_contains(strtolower($data), 'am') && ! str_contains(strtolower($data), 'pm'))
        $data = substr($data, 0, strpos($data, ':') + 3).' '.Carbon::now()->format('A');
      if (!str_contains($data, ':') && str_contains($data, '00'))
        $data = substr($data, 0, strpos($data, '00')).":".substr($data, strpos($data, '00'));
      elseif(!str_contains($data, ':')){
        if (! isset($oldArray[substr($updatedTime, strpos($updatedTime, 'pd'))]))
          $oldArray[substr($updatedTime, strpos($updatedTime, 'pd'))] = Carbon::now()->format('g:i A');
        $newArray[substr($updatedTime, strpos($updatedTime, 'pd'))] = $oldArray[substr($updatedTime, strpos($updatedTime, 'pd'))];

        return ["old" => $oldArray, "new" => $newArray];
      }
      $newArray[substr($updatedTime, strpos($updatedTime, 'pd'))] = $data;
      $oldArray[substr($updatedTime, strpos($updatedTime, 'pd'))] = $data;

      return ["old" => $oldArray, "new" => $newArray];
    }

    /**
     * Update suggestions on updated query
     * @return void
     */
    public function updatedQuery(){
      $this->suggestions = ClassTime::whereNull('user_id')->where('type', 'like', '%' . $this->query . '%')->limit(6)->orderBy('type', 'asc')->get()->toArray();

    }

    /**
     * Sets schedule type from radio button clicks
     * @param string $type Type of schedule used
     */
    public function setScheduleType($type){
      if ($type == "block" || $type == "fixed"){
        $this->scheduleType = $type;
      }
    }

    /**
     * Set number of block days
     * @param int $n
     */
    public function setNumberBlocks($n){
      if ($n > 0 && $n<= 5)
        $this->numberOfBlockDays = $n;
      if ($this->startingBlock > $n)
        $this->startingBlock == $n;
    }

    /**
     * Set starting week
     * @param int $n
     */
    public function setStartingWeek($n){
      if ($n > 0 && $n<= 5){
        $this->startingBlock = $n;
      }
    }

    /**
     * Set number classes
     * @param int $n Number of classes
     */
    public function setNumberClasses($n){
      if ($n > 0 && $n<=10)
        $this->numberClasses = $n;
      for ($i = $n + 1; $i <= 10; $i++){
        $this->customTimes['pd'.$i.'start'] = null;
        $this->customTimes['pd'.$i.'end'] = null;
        $this->oldCustomTimes['pd'.$i.'start'] = null;
        $this->oldCustomTimes['pd'.$i.'end'] = null;
      }
    }

    /**
     * Update fixed schedule array
     * @param  int $period
     * @param  int $day
     * @return void
     */
    public function updateFixedCustomSchedule($period, $day){
      if(in_array($period, $this->customFixedDays[$day]))
        unset($this->customFixedDays[$day][array_search($period, $this->customFixedDays[$day])]);
      else{
        array_push($this->customFixedDays[$day], $period);
        if ($day == 'M' && $this->customFixedDays[$day][0] == 'async')
          unset($this->customFixedDays['M'][0]);
      }
    }

    /**
     * Update block schedule array
     * @param  int $period
     * @param  int $block
     * @return void
     */
    public function updateBlockCustomSchedule($period, $block){
      if(in_array($period, $this->customBlockDays[$block]))
        unset($this->customBlockDays[$block][array_search($period, $this->customBlockDays[$block])]);
      else
        array_push($this->customBlockDays[$block], $period);
    }

    /**
     * Saves fixed style schedule
     * @return void
     */
    public function saveFixedSchedule(){
      $schedule = ClassTime::where('user_id', Auth::user()->id)->first();
      if ($schedule == null)
        $schedule = new ClassTime;
      $schedule->type = "user";
      $schedule->user_id = Auth::User()->id;
      $schedule->block1 = null;
      $schedule->block2 = null;
      $schedule->block3 = null;
      $schedule->block4 = null;
      $schedule->block5 = null;
      $schedule->number_of_classes = $this->numberClasses;

      $schedule->schedule_type="normal";
      $startTimes = [];
      $endTimes = [];
      foreach ($this->customTimes as $key => $item) {
        if($item == null)
          ;
        elseif(str_contains($key, 'start'))
          array_push($startTimes, Carbon::create($item)->format('Hi'));
        elseif(str_contains($key, 'end'))
          array_push($endTimes, Carbon::create($item)->format('Hi'));
      }

      $schedule->number_of_classes = $this->numberClasses;
      $schedule->fixed_start_times = implode(',', $startTimes);
      $schedule->fixed_end_times = implode(',', $endTimes);
      $schedule->Monday = implode(',', $this->customFixedDays['M']);
      $schedule->Tuesday = implode(',', $this->customFixedDays['T']);
      $schedule->Wednesday = implode(',', $this->customFixedDays['W']);
      $schedule->Thursday = implode(',', $this->customFixedDays['Th']);
      $schedule->Friday = implode(',', $this->customFixedDays['F']);
      $schedule->save();

      $this->emit('toastMessage', 'Schedule was successfully saved');

      $newSchedule = ClassTime::where('user_id', Auth::user()->id)->first();
      $user = Auth::User();
      $user->schedule_id = $newSchedule->id;
      $user->save();

      $this->schedule = ClassTime::where('id', Auth::user()->schedule_id)->first();
      $this->mount();
    }

    public function saveBlockSchedule(){
      $schedule = ClassTime::where('user_id', Auth::user()->id)->first();
      if ($schedule == null){
          $schedule = new ClassTime;
      }
      $schedule->type = "user";
      $schedule->user_id = Auth::User()->id;
      $schedule->schedule_type = "block";
      $schedule->fixed_start_times = null;
      $schedule->fixed_end_times = null;
      $schedule->Monday = null;
      $schedule->Tuesday = null;
      $schedule->Wednesday = null;
      $schedule->Thursday = null;
      $schedule->Friday = null;

      $schedule->number_of_blocks = $this->numberOfBlockDays;
      $schedule->number_of_classes = $this->numberClasses;
      $schedule->starting_block = $this->startingBlock;
      $schedule->starting_date = Carbon::now()->startOfWeek(Carbon::MONDAY)->toDateString();
      $schedule->block_style = $this->blockStyle;
      $startTimes = [
        "1" => [],
        "2" => [],
        "3" => [],
        "4" => [],
        "5" => []
      ];
      $endTimes = [
        "1" => [],
        "2" => [],
        "3" => [],
        "4" => [],
        "5" => []
      ];
      $setTimes = $this->customTimes;
      for($i = 1; $i<=$this->numberOfBlockDays; $i++){
        foreach($this->customBlockDays[$i] as $item){
          array_push($startTimes[$i], Carbon::create($this->customTimes['pd'.$item.'start'])->format('Hi'));
          array_push($endTimes[$i], Carbon::create($this->customTimes['pd'.$item.'end'])->format('Hi'));
        }
      }
      $schedule->block1 = implode(',', $this->customBlockDays[1]);
      $schedule->block1_start = implode(',', $startTimes[1]);
      $schedule->block1_end = implode(',', $endTimes[1]);

      $schedule->block2 = implode(',', $this->customBlockDays[2]);
      $schedule->block2_start = implode(',', $startTimes[2]);
      $schedule->block2_end = implode(',', $endTimes[2]);

      $schedule->block3 = implode(',', $this->customBlockDays[3]);
      $schedule->block3_start = implode(',', $startTimes[3]);
      $schedule->block3_end = implode(',', $endTimes[3]);

      $schedule->block4 = implode(',', $this->customBlockDays[4]);
      $schedule->block4_start = implode(',', $startTimes[4]);
      $schedule->block4_end = implode(',', $endTimes[4]);

      $schedule->block5 = implode(',', $this->customBlockDays[5]);
      $schedule->block5_start = implode(',', $startTimes[5]);
      $schedule->block5_end = implode(',', $endTimes[5]);

      $schedule->save();
      $this->emit('toastMessage', 'Schedule was successfully saved');

      $newSchedule = ClassTime::where('user_id', Auth::user()->id)->first();
      $user = Auth::User();
      $user->schedule_id = $newSchedule->id;
      $user->save();

      $this->schedule = ClassTime::where('id', Auth::user()->schedule_id)->first();
      $this->mount();
    }

    public function useExistingSchedule($id){
      $newSchedule = ClassTime::where('id', $id)->first();
      $this->schedule = $newSchedule;
      $this->query = $newSchedule->type." - ".$newSchedule->location;
      if ($newSchedule->type != "user")
        $this->selectedSchedule = $id;

      else{
        $this->addError('query', 'The schedule selected is invalid');
      }
    }

    public function saveExistingSchedule(){
      $user = Auth::User();
      $user->schedule_id = $this->selectedSchedule;
      $this->emit('toastMessage', 'Schedule sucessfully updated');
      $this->dispatchBrowserEvent('hide-query');
      $user->save();
      $newClass = ClassTime::where('id', Auth::user()->schedule_id)->first();
      $this->schoolName = $newClass->type;
    }

    /**
     * Copies preset school schedule to allow user to edit
     * @return void
     */
    public function copyAndEdit(){
      ClassTime::where('user_id', Auth::user()->id)->delete();
      $schedule = $this->schedule;
      $newSchedule = $schedule->replicate();
      $newSchedule->type = "user";
      $newSchedule->inherit_from = $schedule->id;
      $newSchedule->user_id = Auth::User()->id;
      $newSchedule->location = null;
      $newSchedule->save();

      $newSchedule = ClassTime::where('user_id', Auth::user()->id)->first();
      $user = Auth::User();
      $user->schedule_id = $newSchedule->id;
      $this->usingCustomSchedule = true;
      $user->save();

      $this->schedule = ClassTime::where('id', Auth::user()->schedule_id)->first();
      $this->mount();
      $this->emit('toastMessage', 'Schedule sucessfully copied');
    }

    public function render(){
      return view('livewire.profile.schedule.manage-schedule');
    }
}
