<?php

namespace App\Http\Livewire\Schedule;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

use Livewire\Component;
use App\Classes\Schedule\Schedule;
use Illuminate\Support\Facades\Auth;

class AgendaWidget extends Component
{
    /**
     * @var array
     */
    public array $agenda;

    public Carbon $initDate;

    protected $listeners = ['updateAgendaData'];

    public function mount()
    {
        if (!isset($this->initDate)) {
            $this->initDate = Carbon::now();
        }
        $this->agenda = Schedule::getSingleMonth(
            $this->createMonthPeriod(Carbon::make($this->initDate))
        )->toArray();
    }

    /**
     * Update current month with provided date and reload events
     * @param  string $date
     * @return void
     */
    public function setDate(string $date): void
    {
        $this->initDate = Carbon::parse($date)->startOfMonth();
        $this->agenda = Schedule::getSingleMonth(
            $this->createMonthPeriod(Carbon::make($this->initDate))
        )->toArray();

        $this->dispatchBrowserEvent('update-current-date');
    }

    /**
     * Get month period for specified date
     * @param  Carbon $date
     * @return CarbonPeriod
     */
    public function createMonthPeriod(Carbon $date): CarbonPeriod
    {
        $start = $date->startOfMonth()->toDateString();
        $end = $date->endOfMonth()->toDateString();
        $range = CarbonPeriod::create($start, $end);

        return $range;
    }

    /**
     * Update the agenda with new data
     *
     * @return void
     */
    public function updateAgendaData(): void
    {
        $this->setDate($this->initDate);
        $this->agenda = Schedule::getSingleMonth(
            $this->createMonthPeriod(Carbon::make($this->initDate))
        )->toArray();
    }

    /**
     * Return the user's event invitations
     *
     * @return array
     */
    public function getInvitations(): array
    {
        return Auth::user()
            ->invites()
            ->with('creator')
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.schedule.agenda-widget');
    }
}
