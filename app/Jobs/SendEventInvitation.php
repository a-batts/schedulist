<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\EventInvitation;
use Mail;
use Config;

class SendEventInvitation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $details;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $transport = (new \Swift_SmtpTransport('smtp.hostinger.com', '587'))
        ->setEncryption('tls')
        ->setUsername('noreply@schedulist.xyz')
        ->setPassword('P5paj4tFWQL4nCs');

        $mailer = app(\Illuminate\Mail\Mailer::class);
        $mailer->setSwiftMailer(new \Swift_Mailer($transport));
        $mail = $mailer
            ->to($this->details['email'])
            ->send(new EventInvitation($this->details['owner'], $this->details['eventName'], $this->details['route']));
    }
}
