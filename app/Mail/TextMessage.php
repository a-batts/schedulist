<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Auth;

class TextMessage extends Mailable
{

    use Queueable, SerializesModels;

    public $subject = '';

    public $messageText;

    protected $carriers = [
      'Verizon Wireless' => '@vtext.com',
      'T-Mobile' => '@tmomail.net',
      'AT+T Mobility' => '@txt.att.net',
      'Sprint' => '@messaging.sprintpcs.com'
    ];

    protected function buildSubject($message)
    {
        $message->subject($this->subject);

        return $this;
    }

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message) {
        $this->messageText = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
      return $this->from('reminders@schedulist.xyz', '')
                  ->subject(' ')
                  ->replyTo('reminders@schedulist.xyz', 'reminders@schedulist.xyz')
                  ->view('emails.text_message');
    }
}
