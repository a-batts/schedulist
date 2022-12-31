<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class TextMessage extends Mailable {

  use Queueable, SerializesModels;

  public string $message;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($message) {
    $this->message = $message;
  }

  /**
   * Get the message envelope.
   *
   * @return \Illuminate\Mail\Mailables\Envelope
   */
  public function envelope() {
    return new Envelope(
      from: new Address('reminders@schedulist.xyz', ''),
      subject: (' ')
    );
  }

  /**
   * Get the message content definition.
   *
   * @return \Illuminate\Mail\Mailables\Content
   */
  public function content() {
    return new Content(
      view: 'emails.text-message',
    );
  }
}
