<?php

namespace App\Mail;

use App\Models\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $ownerName;

    public $ownerEmail;

    public $eventName;

    public $route;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $owner, string $eventName, string $route){
      $this->eventName = $eventName;
      $this->ownerName = $owner->firstname.' '.$owner->lastname;
      $this->ownerEmail = $owner->email;
      $this->route = $route;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@schedulist.xyz', 'Schedulist')
            ->subject('An event was shared with you: "'.$this->eventName.'"')
            ->view('emails.event_invitation');
    }
}
