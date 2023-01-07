<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\EventInvitation;
use Illuminate\Support\Facades\Mail;

class SendEventInvitation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Email data
     *
     * @var array
     */
    public array $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $settings = $this->data['user']->settings;

        if ($settings->eventEmailsEnabled()) {
            Mail::to($this->data['user'])->send(
                new EventInvitation($this->data)
            );
        }
    }
}
