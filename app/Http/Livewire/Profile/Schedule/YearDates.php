<?php

namespace App\Http\Livewire\Profile\Schedule;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class YearDates extends Component
{
    public $termStartDate;
    public $termEndDate;

    protected $listeners = ['updateStartDate', 'updateEndDate'];

    public function mount(){
      if (Auth::User()->year_start_date != null)
        $this->termStartDate = Carbon::parse(Auth::User()->year_start_date)->format('Y-m-d');
      else
        $this->termStartDate = Carbon::now()->format('Y-m-d');
      if (Auth::User()->year_end_date != null)
        $this->termEndDate = Carbon::parse(Auth::User()->year_end_date)->format('Y-m-d');
      else
        $this->termEndDate = Carbon::now()->addYear()->format('Y-m-d');
    }

    /**
     * Update date from Vue
     * @param  string $value
     * @return void
     */
    public function updateStartDate($value){
      $this->termStartDate = $value;
    }

    public function updateEndDate($value){
      $this->termEndDate = $value;
    }

    /**
     * Save the new start and end dates
     * @return void
     */
    public function saveTermDates(){
      $user = Auth::User();
      $user->year_start_date = $this->termStartDate;
      $user->year_end_date = $this->termEndDate;
      $user->save();
      $this->emit('refreshScheduleSettings');
      $this->emit('toastMessage', 'Saved');
    }

    public function render(){
      $this->emit('setStartDate', $this->termStartDate);
      $this->emit('setEndDate', $this->termEndDate);
      return view('livewire.profile.schedule.year-dates');
    }
}
