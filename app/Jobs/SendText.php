<?php

namespace App\Jobs;

use App\Mail\TextMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class SendText implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $details;

    /*
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
        if (str_contains($this->details['email'], 'vtext')) {
            //@vtext is broken so send an actual text if the user has Verizon
            $sid = config('twilio.account_sid');
            $token = config('twilio.auth_token');
            $twilio = new Client($sid, $token);

            $twilio->messages->create(
                explode('@', $this->details['email'])[0],
                [
                    'body' => $this->details['message'],
                    'from' => '+15715208808',
                ]
            );
        } else
            Mail::to($this->details['email'])->send(new TextMessage($this->details['message']));
    }
}
