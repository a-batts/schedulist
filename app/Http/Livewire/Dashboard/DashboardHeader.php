<?php

namespace App\Http\Livewire\Dashboard;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;

  class DashboardHeader extends Component
{
    public $dayOfWeekString;
    public string $greeting;

    protected $listeners = ['updateCurrentBlock' => 'setCurrentBlock'];

    public function mount(){
      $this->greeting = $this->getGreeting();
      $this->dayOfWeekString = $this->getDayOfWeekString();
    }

    /**
     * Returns the current block for the day of the week, or null if the schedule type is not block
     * @return string|null
     */
    public function getDayOfWeekString(){
      $classSchedule = Auth::User()->classSchedule->first();
      if ($classSchedule == null)
        return null;
      if ($classSchedule->schedule_type == 'block'){
        $range = CarbonPeriod::create($classSchedule->schedule_start, Carbon::now());
        $count = $classSchedule->start_block - 1;
        foreach ($range as $i){
          if (!$i->isWeekend())
            $count++;
        }
        $currentBlock = $count % $classSchedule->number_blocks;
        if ($currentBlock == 0)
          $currentBlock = 3;
        return 'You have your '.chr(ord('A') + $currentBlock - 1).' classes today';
      }
    }

    /**
     * Get greeting string
     * @return string
     */
    public function getGreeting(){
      $now = Carbon::now()->format('G');
      switch ($now) {
        case 5:
        case 6:
        case 7:
        case 8:
        case 9:
        case 10:
        case 11:
          return 'Good morning';
        case 12:
        case 13:
        case 14:
        case 15:
          return 'Good afternoon';
        case 16:
        case 17:
        case 18:
          return 'Good evening';
        default:
          return 'Have a good night';
      }
    }

    public function refresh(){
      $this->greeting = $this->getGreeting();
      $this->dayOfWeekString = $this->getDayOfWeekString();
    }

    public function render(){
      return view('livewire.dashboard.dashboard-header');
    }
}
