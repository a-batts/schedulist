<?php

namespace App\Http\Livewire\Contact;

use Livewire\Component;
use Auth;
use Mail;
use App\Mail\ContactUs;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $reason;
    public $message;

    function rules(){
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
    public function mount(){
      if (Auth::check()){
        $this->name = Auth::User()->firstname.' '.Auth::User()->lastname;
        $this->email = Auth::User()->email;
      }
      else{
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
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    /**
     * Submit contact form
     * @return void
     */
    public function submit(){
      $this->validate();

      if (! $this->reason){
        $this->addError('reason', 'A message reason is required');
        return;
      }

      if(! $this->email){
        $this->email = 'feedback@schedulist.xyz';
        $replyName = 'NO REPLY';
      }
      else
        $replyName = $this->name;

      $mail_data = [
        'name' => $this->name,
        'reason' => $this->reason,
        'message' => $this->message,
        'sendFrom' => $this->email,
        'replyName' => $replyName,
      ];

      $this->sendEmail($mail_data);
    }

    /**
     * Sends email with form data
     * @param  array  $data
     * @return void
     */
    public function sendEmail(array $data){
      $this->emit('startloading');
      $transport = (new \Swift_SmtpTransport('smtp.hostinger.com', '587'))
        ->setEncryption('tls')
        ->setUsername('feedback@schedulist.xyz')
        ->setPassword('***REMOVED***');

        $mailer = app(\Illuminate\Mail\Mailer::class);
        $mailer->setSwiftMailer(new \Swift_Mailer($transport));

        $mail = $mailer
            ->to('mail@schedulist.xyz')
            ->send(new ContactUs($data));

        $this->message = null;
        $this->emit('toastMessage', 'Message sent! We\'ll get back to you soon.');
        $this->dispatchBrowserEvent('disable-send-button');
        $this->emit('stoploading');
    }

    /**
     * Sets value of reason property from select component
     * @param string $value
     */
    public function setReason(string $value){
      $this->reason = $value;
    }

    public function render(){
        return view('livewire.contact.contact-form')->layout('layouts.guest', ['title' => 'Contact Us']);
    }
}
