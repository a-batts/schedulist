<?php

namespace App\Jobs;

use App\Actions\Core\NotifyUser;
use App\Helpers\CarrierEmailHelper;
use App\Models\Assignment;
use App\Models\AssignmentReminder;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class SendAssignmentReminder implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected AssignmentReminder $reminder;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(AssignmentReminder $reminder) {
        $this->reminder = $reminder;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        $assignment = $this->reminder->assignment;
        $settings = $assignment->user->settings;

        $message = 'Reminder: Your assignment "' . $assignment->name . '" is due in ' . $this->reminder->hours_before . ' hours.';

        $notification = NotifyUser::createNotification($message, $assignment->user);

        if ($settings->assignmentTextsEnabled())
            $notification->sendText();

        if ($settings->assignmentEmailsEnabled())
            $notification->sendEmail();
    }
}
