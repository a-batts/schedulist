<?php

namespace App\Jobs;

use App\Actions\Core\NotifyUser;
use App\Models\AssignmentReminder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendAssignmentReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The assignment reminder to send
     *
     * @var AssignmentReminder
     */
    protected AssignmentReminder $reminder;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(AssignmentReminder $reminder)
    {
        $this->reminder = $reminder;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $assignment = $this->reminder->assignment;
        $settings = $assignment->user->settings;

        if ($settings->assignmentTextsEnabled()) {
            NotifyUser::createNotification(
                'Reminder: Your assignment "' .
                    $assignment->name .
                    '" is due in ' .
                    $this->reminder->hours_before .
                    ' hours.',
                $assignment->user
            )->sendText();
        }

        if ($settings->assignmentEmailsEnabled()) {
            NotifyUser::createNotification(
                [
                    'heading' => 'Don\'t forget to finish ' . $assignment->name,
                    'body' =>
                        'Reminder: Your assignment "' .
                        $assignment->name .
                        '" is due in ' .
                        $this->reminder->hours_before .
                        ' hours.',
                    'link' => $assignment->link,
                    'link-title' => 'View assignment details',
                    'footer' =>
                        'You received this email because you have assignment reminder emails turned on.',
                    'subject' => 'Schedulist: Assignment due date reminder',
                ],
                $assignment->user
            )->sendEmail();
        }
    }
}
