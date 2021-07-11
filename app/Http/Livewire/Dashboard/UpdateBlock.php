<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\ClassTime;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class UpdateBlock extends Component
{
    public $userSchedule;
    public $blockStyle;
    public $numberOfBlocks;
    public $currentBlock;
    public $newTodayBlock;

    public $labels = [];

    /**
     * Mount the component
     * @return void
     */
    public function mount(){
      if (Auth::User()->schedule_id == null)
        return;
      $this->userSchedule = $userSchedule = ClassTime::where('id', Auth::User()->schedule_id)->first();
      $this->blockStyle = $this->userSchedule->block_style;
      $this->numberOfBlocks = $this->userSchedule->number_of_blocks;
      $this->newTodayBlock = $this->currentBlock;

      if ($this->blockStyle == 'letter')
        $this->labels = ['A','B','C','D','E'];
      else
        $this->labels = [1, 2, 3, 4, 5];
    }


    public function setTodayBlock($block){
      if($this->blockStyle == "letter")
        $this->newTodayBlock = $this->toNum($block);
      else
        $this->newTodayBlock = $block;
    }

    /**
     * Convert the block letter to a number
     * @param  string $char
     * @return int
     */
    public function toNum($char): int{
      return ord($char) - ord('A') + 1;
    }

    /**
     * Save the new data
     * @return void
     */
    public function save(){
      $userSchedule = $this->userSchedule;
      $userSchedule->starting_date = Carbon::now()->toDateString();
      $userSchedule->starting_block = $this->newTodayBlock;
      $userSchedule->save();
      $this->dispatchBrowserEvent('hide-change-block-dialog');
      $this->emit('toastMessage', 'Saved');
      $this->emit('refreshClasses');
      $this->emit('updateCurrentBlock', $this->newTodayBlock);

    }

    public function render(){
      $this->userSchedule = ClassTime::where('id', Auth::User()->schedule_id)->first();

      return view('livewire.dashboard.update-block');
    }
}
