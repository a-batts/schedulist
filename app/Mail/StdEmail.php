<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StdEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Email data
     *
     * @var array
     */
    public array $data;

    /**
     * The template to use for the email
     *
     * @var string
     */
    public string $template = 'blank-email';

    /**
     * Create a new message instance.
     *
     * Data fields to fill in if using the default `blank-email` template:
     *
     * `subject`: Email subject
     *
     * `heading`: Email title
     *
     * `icon`: (Optional) material icon to include on the email
     *
     * `link` and `link-title`: (Optional) a link and the associated link title, displayed as a button
     *
     * `footer`: Footer message text
     *
     * @return void
     */
    public function __construct(array $data, ?string $template)
    {
        $this->data = $data;
        $this->template = $template ?? $this->template;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('noreply@schedulist.xyz', 'Schedulist'),
            subject: $this->data['subject']
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content(): Content
    {
        return new Content(view: 'emails.' . $this->template);
    }
}
