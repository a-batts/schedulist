<?php

namespace App\Jobs;

use App\Mail\TextMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Twilio\Rest\Client;

class SendText implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $details;
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
            //VText is broken so send a text if the user has Verizon

            $sid = config('twilio.account_sid');
            $token = config('twilio.auth_token');
            $twilio = new Client($sid, $token);

            $twilio->messages->create(
                Auth::User()->phone,
                [
                    'body' => $this->details['message'],
                    'from' => '+15715208808',
                ]
            );
        } else {
            $transport = (new \Swift_SmtpTransport('smtp.hostinger.com', '587'))
                ->setEncryption('tls')
                ->setUsername('reminders@schedulist.xyz')
                ->setPassword(env('REMINDER_EMAIL_PASSWORD'));

            $mailer = app(\Illuminate\Mail\Mailer::class);
            $mailer->setSwiftMailer(new \Swift_Mailer($transport));
            $mail = $mailer
                ->to($this->details['email'])
                ->send(new TextMessage($this->details['message']));
        }
    }
}
