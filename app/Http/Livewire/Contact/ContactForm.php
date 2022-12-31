<?php

namespace App\Http\Livewire\Contact;

use Livewire\Component;
use Auth;
use Mail;
use App\Mail\ContactUs;
use Google\Service\AuthorizedBuyersMarketplace\Contact;

class ContactForm extends Component {
  public $name;
  public $email;
  public $reason;
  public $message;

  function rules() {
    return [
      'name' => 'required',
      'email' => 'nullable|email',
      'reason' => 'required',
      'message' => 'required|max:250'
    ];
  }

  /**
   * Mount Component
   * @return void
   */
  public function mount() {
    if (Auth::check()) {
      $this->name = Auth::User()->firstname . ' ' . Auth::User()->lastname;
      $this->email = Auth::User()->email;
    } else {
      $this->name = null;
      $this->email = null;
    }
    $this->reason = null;
    $this->message = null;
  }

  /**
   * Validate updated properties
   * @param  mixed $propertyName
   * @return void
   */
  public function updated($propertyName) {
    $this->validateOnly($propertyName);
  }

  /**
   * Submit contact form
   * @return void
   */
  public function submit() {
    $this->validate();

    if (!$this->reason) {
      $this->addError('reason', 'A message reason is required');
      return;
    }

    if (!$this->email) {
      $this->email = 'feedback@schedulist.xyz';
      $replyName = 'NO REPLY';
    } else
      $replyName = $this->name;

    $data = [
      'name' => $this->name,
      'reason' => $this->reason,
      'message' => $this->message,
      'sendFrom' => $this->email,
      'replyName' => $replyName,
    ];

    $this->sendEmail($data);
  }

  /**
   * Sends email with form data
   * @param  array  $data
   * @return void
   */
  public function sendEmail(array $data) {
    Mail::to('mail@schedulist.xyz')->send(new ContactUs($data));
    $this->message = null;
    $this->emit('toastMessage', 'Message sent! We\'ll get back to you soon.');
    $this->dispatchBrowserEvent('disable-send-button');
  }

  /**
   * Sets value of reason property from select component
   * @param string $value
   */
  public function setReason(string $value) {
    $this->reason = $value;
  }

  public function render() {
    return view('livewire.contact.contact-form')->layout('layouts.guest', ['title' => 'Contact Us']);
  }
}
