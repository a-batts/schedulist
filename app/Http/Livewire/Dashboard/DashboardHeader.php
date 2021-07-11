<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\ClassTime;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class DashboardHeader extends Component
{
    public $timeString;
    public $blockString;

    public $currentBlock;

    protected $listeners = ['updateCurrentBlock' => 'setCurrentBlock'];

    /**
     * Gets string for the time of day greeting
     * @return [type]
     */
    public function getTimeString(){
      $now = Carbon::now()->format('G');
      if ($now >= 4 && $now < 12)
        $this->timeString = "Good Morning";
      elseif ($now >= 12 && $now < 16)
        $this->timeString = "Good Afternoon";
      elseif ($now >= 16 && $now < 19)
        $this->timeString = "Good Evening";
      else
        $this->timeString = "Have a Good Night";
    }

    public function setCurrentBlock($newBlock){
      $this->currentBlock = $newBlock;
    }

    /**
     * Get block string to display
     * @param int $blockNumber
     * @return string
     */
    public function getBlockString  ($blockNumber){
      $userSchedule = ClassTime::where('id', Auth::User()->schedule_id)->first();
      if (Auth::User()->schedule_id == null)
        return null;
      if ($userSchedule->schedule_type == "block" && $blockNumber != "off"){
        $blockString = "You have your ";
        if($userSchedule->block_style == "number")
          $blockString .= $blockNumber;
        elseif($userSchedule->block_style == "letter")
          $blockString .= chr(ord('A') + $blockNumber - 1);
        $blockString .= " day classes today";

        return $blockString;
      }
    }

    public function render(){
        $this->blockString = $this->getBlockString($this->currentBlock);
        $this->getTimeString();
        return view('livewire.dashboard.dashboard-header');
    }
}
