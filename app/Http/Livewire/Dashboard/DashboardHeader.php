<?php

namespace App\Http\Livewire\Dashboard;

use Carbon\Carbon;

use Livewire\Component;

class DashboardHeader extends Component
{
    public string $greeting;

    public function mount()
    {
        $this->greeting = $this->getGreeting();
    }

    /**
     * Get greeting string
     * @return string
     */
    public function getGreeting(): string
    {
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

    public function refresh(): void
    {
        $this->greeting = $this->getGreeting();
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-header');
    }
}
