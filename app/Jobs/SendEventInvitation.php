<?php

namespace App\Jobs;

use App\Actions\Core\NotifyUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\EventInvitation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendEventInvitation implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $details;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details) {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        $settings = $this->details['user']->settings;

        if ($settings->eventEmailsEnabled())
            Mail::to($this->details['user'])->send(new EventInvitation($this->details['owner'], $this->details['eventName'], $this->details['route']));
    }
}
