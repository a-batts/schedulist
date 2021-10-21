<?php

namespace App\Jobs;

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

    protected Assignment $assignment;

    protected User $owner;

    protected int $reminderId;

    protected $timeTillDue;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(AssignmentReminder $reminder) {
        $this->assignment = $reminder->assignment;
        $this->owner = $this->assignment->user;
        $this->reminderId = $reminder->id;
        $this->timeTillDue = $reminder->hours_before;
        $this->sent = boolval($reminder->sent);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        if ($this->assignment->status == 'inc' && $this->owner->phone != null && !$this->sent) {
            $message = 'Reminder: Your assignment "' . Crypt::decryptString($this->assignment->assignment_name) . '" is due in ' . $this->timeTillDue . ' hours';
            $email = $this->owner->phone . CarrierEmailHelper::getCarrierEmail($this->owner->carrier);
            $details = ['email' => $email, 'message' => $message];

            SendText::dispatch($details);
            AssignmentReminder::destroy($this->reminderId);
        }
    }
}
