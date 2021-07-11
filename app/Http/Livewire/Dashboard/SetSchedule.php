<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\ClassTime;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class SetSchedule extends Component
{
    public $query;
    public $suggestions = [];
    public $selectedSchedule;
    public $page;

    public bool $saveButtonDisabled = true;
    public bool $scheduleInvalid = false;
    public bool $usingCustomSchedule = false;

    public $scheduleType;
    public $numberClasses;
    public $numberOfBlockDays;
    public $startingBlock;
    public $blockStyle;

    public $endTermDate;


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

    protected $listeners = ['updateDate'];

    /**
     * Mount the component
     * @return void
     */
    public function mount(){
      $this->query = "";
      $this->page = 1;
      $this->suggestions = ClassTime::whereNull('user_id')->where('type', 'like', '%' . "" . '%')->limit(5)->orderBy('type', 'asc')->get()->toArray();
      for ($i=1; $i <= 10; $i++){
        $this->customTimes['pd'.$i.'start'] = null;
        $this->customTimes['pd'.$i.'end'] = null;
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
      $this->selectedSchedule = null;

      if($this->query == null)
        $this->saveButtonDisabled = true;
    }

    /**
     * Reset schedule identification on toggle
     * @return void
     */
    public function updatedUsingCustomSchedule(){
      $this->query = "";
      $this->selectedSchedule = null;
      $this->saveButtonDisabled = true;
    }

    /**
     * Link an existing schedule to the user
     * @param  int $id
     * @return void
     */
    public function useExistingSchedule($id){
      $newSchedule = ClassTime::where('id', $id)->first();
      $this->query = $newSchedule->type." - ".$newSchedule->location;
      if ($newSchedule->type != "user"){
        $this->selectedSchedule = $id;
        $this->saveButtonDisabled = false;
      }
      else{
        $this->addError('query', 'The schedule selected is invalid');
      }
    }

    /**
     * Sets schedule type from radio button clicks
     * @param string $type Type of schedule used
     */
    public function setScheduleType($type){
      if ($type == "block" || $type == "fixed"){
        $this->scheduleType = $type;
        if ($type == "fixed")
          $this->saveButtonDisabled = false;
        else
          $this->saveButtonDisabled = true;
        if ($this->numberOfBlockDays != null && $this->startingBlock != null)
          $this->saveButtonDisabled = false;
      }
    }

    /**
     * Set number of block days
     * @param int $n
     */
    public function setNumberBlocks($n){
      if ($n > 0 && $n<= 5){
        $this->numberOfBlockDays = $n;
        if($this->startingBlock != null)
          $this->saveButtonDisabled = false;
      }
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
        if($this->numberOfBlockDays != null)
          $this->saveButtonDisabled = false;
      }
    }

    /**
     * Increment page
     * @return void
     */
    public function incrementPage(){
      if ($this->usingCustomSchedule){
        if($this->page == 2){
          $this->createNewSchedule();
          if ($this->scheduleType == "fixed"){
            $this->emit('toastMessage', 'Schedule has been sucessfully set');
            $this->dispatchBrowserEvent('close-schedule-dialog');
            return;
          }

        }
        $this->page += 1;
        $this->saveButtonDisabled = true;
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
      $this->saveButtonDisabled = false;
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
      else
        array_push($this->customFixedDays[$day], $period);
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

    /*
    Vue is currently not behaving - removing for the time being until it is fiex

    public function updateDate($date){
      $this->endTermDate = $date;
      if($this->scheduleType != "block")
        $this->saveButtonDisabled = false;
      if(isset($this->blockStyle))
        $this->saveButtonDisabled = false;
    }
    */

    public function setBlockStyling($style){
      if ($style == "number" || $style == "letter"){
        $this->blockStyle = $style;
        //if(isset($this->endTermDate))
          $this->saveButtonDisabled = false;
      }
    }

    /**
     * Create new custom schedule for user
     * @return void
     */
    public function createNewSchedule(){
      $schedule = new ClassTime;
      $schedule->type = "user";
      $schedule->user_id = Auth::User()->id;

      if($this->scheduleType == "fixed"){
        $schedule->schedule_type="fixed";
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

        $newSchedule = ClassTime::where('user_id', Auth::user()->id)->first();
        $user = Auth::User();
        $user->schedule_id = $newSchedule->id;
        $user->save();

        $this->emit('refreshClasses');
      }
      elseif($this->scheduleType == "block"){
        $schedule->schedule_type="block";
        $schedule->number_of_blocks = $this->numberOfBlockDays;
        $schedule->number_of_classes = $this->numberClasses;
        $schedule->starting_block = $this->startingBlock;
        $schedule->starting_date = Carbon::now()->startOfWeek(Carbon::MONDAY)->toDateString();
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

        $newSchedule = ClassTime::where('user_id', Auth::user()->id)->first();
        $user = Auth::User();
        $user->schedule_id = $newSchedule->id;
        $user->save();

        $this->emit('refreshClasses');
      }
    }

    /**
     * Link schedule to user model
     * @return void
     */
    public function save(){
      if (! $this->usingCustomSchedule){
        $user = Auth::User();
        $user->schedule_id = $this->selectedSchedule;
        $user->save();
        $this->emit('toastMessage', 'Schedule has been sucessfully set');
        $this->dispatchBrowserEvent('close-schedule-dialog');
        $this->emit('refreshClasses');
      }
    }

    /**
     * Final save on the custom user times
     * @return void
     */
    public function saveCustom(){
      $schedule = ClassTime::where('user_id', Auth::user()->id)->first();
      //$schedule->year_end_date = Carbon::parse($this->endTermDate)->format('Y-m-d');
      if($this->scheduleType == "block")
        $schedule->block_style = $this->blockStyle;
      $schedule->save();
      $this->emit('toastMessage', 'Schedule has been sucessfully set');
      $this->dispatchBrowserEvent('close-schedule-dialog');
      $this->emit('refreshClasses');

    }

    public function render(){
        return view('livewire.dashboard.set-schedule');
    }
}
