<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    public $mail_data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $mail_data)
    {
        $this->mail_data = $mail_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->from('feedback@schedulist.xyz', 'Feedback Emails')
                  ->subject('Contact Form Message: '.$this->mail_data['reason'])
                  ->replyTo($this->mail_data['sendFrom'], $this->mail_data['replyName'])
                  ->view('emails.contactus');
    }
}
