<?php

namespace App\Http\Livewire\Dashboard;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ClassDetails extends Component
{
    /**
     * Array of the user's class data
     *
     * @var array
     */
    public array $classData;

    /**
     * Array of a user's schedules
     *
     * @var array
     */
    public array $schedules;

    protected $listeners = ['refreshClasses' => 'updateClassData'];

    /**
     * Mount the component
     *
     * @return void
     */
    public function mount(): void
    {
        $this->classData = Auth::user()
            ->classes()
            ->with(['assignments', 'links', 'times'])
            ->get()
            ->keyBy('id')
            ->toArray();
        $this->schedules = Auth::user()
            ->schedules()
            ->get()
            ->keyBy('id')
            ->toArray();
    }

    /**
     * Update class data on the editing or creation of a new class
     *
     * @return void
     */
    public function updateClassData(): void
    {
        $this->classData = Auth::user()
            ->classes()
            ->with(['assignments', 'links', 'times'])
            ->get()
            ->keyBy('id')
            ->toArray();
    }

    public function getScheduleNames(): array
    {
        foreach ($this->schedules as $schedule) {
            $names[] = $schedule['name'];
        }
        return $names;
    }

    public function render()
    {
        return view('livewire.dashboard.class-details');
    }
}
