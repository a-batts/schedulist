<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FeedbackForm extends Mailable {
    use Queueable, SerializesModels;

    /**
     * Email data
     *
     * @var array
     */
    public array $mail_data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $mail_data) {
        $this->mail_data = $mail_data;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope() {
        return new Envelope(
            from: new Address('feedback@schedulist.xyz', 'Feedback Email'),
            replyTo: new Address('alex.batts05@gmail.com', 'alex.batts05@gmail.com'),
            subject: ('New contact form message')
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content() {
        return new Content(
            view: 'emails.feedback',
        );
    }
}
