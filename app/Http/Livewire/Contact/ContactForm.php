<?php

namespace App\Http\Livewire\Contact;

use Livewire\Component;
use App\Mail\FeedbackForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactForm extends Component {

  public string $name = '';
  public ?string $email = null;
  public string $reason = '';
  public string $message = '';

  protected function rules() {
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
      $this->name = Auth::user()->name;
      $this->email = Auth::user()->email;
    }
  }

  /**
   * Validate updated properties
   * @param  mixed $propertyName
   * @return void
   */
  public function updated($propertyName): void {
    $this->validateOnly($propertyName);
  }

  /**
   * Submit contact form
   * @return void
   */
  public function submit(): void {
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
  public function sendEmail(array $data): void {
    Mail::to('mail@schedulist.xyz')->send(new FeedbackForm($data));

    $this->message = null;
    $this->emit('toastMessage', 'Message sent! We\'ll get back to you soon.');
    $this->dispatchBrowserEvent('disable-send-button');
  }

  /**
   * Sets value of reason property from select component
   * @param string $value
   */
  public function setReason(string $value): void {
    $this->reason = $value;
  }

  public function render() {
    return view('livewire.contact.contact-form')->layout('layouts.guest', ['title' => 'Contact Us']);
  }
}
