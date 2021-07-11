<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;
use Mail;
use Crypt;
use Carbon\Carbon;
use App\Jobs\SendText;


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
     * Array of carriers to determine email
     * @var array
     */
    protected $carriers = [
      'Verizon Wireless' => '@vtext.com',
      'T-Mobile' => '@tmomail.net',
      'AT&T Wireless' => '@txt.att.net',
      'Sprint' => '@messaging.sprintpcs.com',
      'Google (Grand Central) BWI - Bandwidth.com - SVR' => null,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $fromTime = Carbon::now()->addHour();
            $toTime = Carbon::now()->addHour()->addMinutes(5);
            $messagesToSend = DB::table('assignments')->whereDate('due', $fromTime->toDateString())->whereTime('due', '>=' , $fromTime->toTimeString())->whereTime('due', '<=' , $toTime->toTimeString())->where(['status' => 'inc', 'notifications_disabled' => null])->get();
            foreach ($messagesToSend as $item){
              $message = 'Reminder: Your assignment "'. Crypt::decryptString($item->assignment_name).'" is due in one hour.';
              $user = DB::table('users')->where('id', $item->userid)->first();
              $email = $user->phone.$this->carriers[$user->carrier];

              $userSettings = DB::table('user_settings')->where('user_id', $user->id)->first();
              $details = ['email' => $email, 'message' => $message];
              SendText::dispatch($details);

            }

        })->everyFiveMinutes()->sendOutputTo(storage_path('logerror.txt'));
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
