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

    /**
     * Email data
     *
     * @var array
     */
    public array $data;

    /*
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $data) {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void {
        if (str_contains($this->data['email'], 'vtext')) {
            //@vtext is broken so send an actual text if the user has Verizon
            $sid = config('twilio.account_sid');
            $token = config('twilio.auth_token');
            $twilio = new Client($sid, $token);

            $twilio->messages->create(
                explode('@', $this->data['email'])[0],
                [
                    'body' => $this->data['message'],
                    'from' => '+15715208808',
                ]
            );
        } else
            Mail::to($this->data['email'])->send(new TextMessage($this->data['message']));
    }
}
