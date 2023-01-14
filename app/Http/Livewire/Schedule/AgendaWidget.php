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
     * Array of the agenda data
     *
     * @var array
     */
    public array $agenda;

    /**
     * The initial date to start out with
     *
     * @var Carbon
     */
    public Carbon $initDate;

    protected $listeners = ['updateAgendaData' => 'notifyView'];

    /**
     * Mount the component
     *
     * @return void
     */
    public function mount(): void
    {
        if (!isset($this->initDate)) {
            $this->initDate = Carbon::now();
        }
        $this->agenda = $this->getAgendaData($this->initDate);
    }

    /**
     * Fetch the agenda data
     *
     * @return array
     */
    public function getAgendaData(string $date): array
    {
        $date = Carbon::parse($date)->startOfMonth();
        return Schedule::getMultipleMonths(
            CarbonPeriod::create(
                $date
                    ->copy()
                    ->startOfMonth()
                    ->subMonth(1),
                $date
                    ->copy()
                    ->startOfMonth()
                    ->addMonth(1)
            )
        );
    }

    /**
     * Get the data for a specified month
     *
     * @param string $date
     * @return array
     */
    public function getMonthData(string $date): array
    {
        $date = Carbon::parse($date);
        return Schedule::getSingleMonth(
            CarbonPeriod::create(
                $date->copy()->startOfMonth(),
                $date->copy()->endOfMonth()
            )
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

    public function getAgenda(): array
    {
        return $this->agenda;
    }

    public function notifyView(): void
    {
        $this->dispatchBrowserEvent('agenda-data-updated');
    }

    public function render()
    {
        return view('livewire.schedule.agenda-widget')->with([
            'scaleFactor' => Schedule::SCALE_FACTOR,
        ]);
    }
}
