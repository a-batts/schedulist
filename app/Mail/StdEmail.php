<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StdEmail extends Mailable {
    use Queueable, SerializesModels;

    public $details;

    public $template = 'blank_email';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $template) {
        $this->details = $details;
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->from('noreply@schedulist.xyz', 'Schedulist')
            ->subject($this->details['subject'])
            ->view('emails.' . $this->template);
    }
}
