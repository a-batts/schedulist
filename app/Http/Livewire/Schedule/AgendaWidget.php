<?php

namespace App\Http\Livewire\Schedule;

use App\Classes\Calendar\Agenda;

use App\Models\Event;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class AgendaWidget extends Component
{
    /**
     * @var array
     */
    public $monthAgenda;

    public Carbon $initDate;

    protected $listeners = ['updateAgendaData'];

    public function mount(){
      if (!isset($this->initDate))
        $this->initDate = Carbon::now();
      $this->monthAgenda = new Agenda($this->getMonthPeriod(Carbon::make($this->initDate)));
      $this->monthAgenda = $this->monthAgenda->toArray();
    }

    /**
     * Update current month with provided date and reload events
     * @param  string $date
     * @return void
     */
    public function setDate($date){
      $this->initDate = Carbon::parse($date)->startOfMonth();
      $this->monthAgenda = new Agenda($this->getMonthPeriod(Carbon::parse($date)));
      $this->monthAgenda = $this->monthAgenda->toArray();

      $this->dispatchBrowserEvent('update-current-date');
    }

    /**
     * Get month period for specified date
     * @param  Carbon $date
     * @return CarbonPeriod
     */
    public function getMonthPeriod(Carbon $date){
      $start = $date->startOfMonth()->toDateString();
      $end = $date->endOfMonth()->toDateString();
      $range = CarbonPeriod::create($start, $end);

      return $range;
    }

    public function updateAgendaData(){
      $this->setDate($this->initDate);
    }

    public function render(){
      return view('livewire.schedule.agenda-widget');
    }
}
