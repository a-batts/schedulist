<?php

namespace App\Console;

use App\Jobs\SendAssignmentReminder;
use App\Jobs\SendText;
use App\Models\AssignmentReminder;
use Carbon\Carbon;

use Illuminate\Console\Scheduling\Schedule;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule
            ->call(function () {
                $pending = AssignmentReminder::where(
                    'reminder_time',
                    '>',
                    Carbon::now()
                        ->subMinutes(1)
                        ->toDateTimeString()
                )
                    ->where(
                        'reminder_time',
                        '<=',
                        Carbon::now()
                            ->addMinutes(1)
                            ->toDateTimeString()
                    )
                    ->with(['assignment', 'assignment.user'])
                    ->get();
                foreach ($pending as $reminder) {
                    SendAssignmentReminder::dispatch($reminder);
                }
            })
            ->everyMinute()
            ->sendOutputTo(storage_path('logerror.txt'));
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
