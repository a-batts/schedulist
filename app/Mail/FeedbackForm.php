<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FeedbackForm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Email data
     *
     * @var array
     */
    public array $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('feedback@schedulist.xyz', 'Feedback Email'),
            replyTo: new Address(
                'alex.batts05@gmail.com',
                'alex.batts05@gmail.com'
            ),
            subject: 'New contact form message - ' . $this->data['reason']
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content(): Content
    {
        return new Content(view: 'emails.feedback');
    }
}
