<?php

namespace App\Jobs;

use App\Mail\StdEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendStdEmail implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $details;
    public $template = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details, $template) {
        $this->details = $details;
        $this->template = $template;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        $transport = (new \Swift_SmtpTransport('smtp.hostinger.com', '587'))
            ->setEncryption('tls')
            ->setUsername('noreply@schedulist.xyz')
            ->setPassword(env('NOREPLY_EMAIL_PASSWORD'));

        $mailer = app(\Illuminate\Mail\Mailer::class);
        $mailer->setSwiftMailer(new \Swift_Mailer($transport));
        $mail = $mailer
            ->to($this->details['email'])
            ->send(new StdEmail($this->details['data'], $this->template));
    }
}
