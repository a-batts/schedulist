<?php

namespace App\Http\Livewire\Contact;

use Livewire\Component;
use App\Mail\FeedbackForm;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class ContactForm extends Component
{
    use WithRateLimiting;

    /**
     * The user's name
     *
     * @var string
     */
    public string $name = '';

    /**
     * The user's email
     *
     * @var string|null
     */
    public ?string $email = null;

    /**
     * The subject of the message
     *
     * @var string
     */
    public string $subject = '';

    /**
     * The message being sent
     *
     * @var string
     */
    public string $message = '';

    /**
     * Validation rules
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'nullable|email',
            'subject' => 'required',
            'message' => 'required|max:250',
        ];
    }

    /**
     * Mount Component
     * @return void
     */
    public function mount()
    {
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
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Submit contact form
     * @return void
     */
    public function submit(): void
    {
        try {
            $this->rateLimit(maxAttempts: 1, decaySeconds: 60 * 20);
            $this->validate();

            if (!$this->subject) {
                throw ValidationException::withMessages([
                    'reason' => 'A message reason is required',
                ]);
            }

            if (!$this->email) {
                $this->email = 'feedback@schedulist.xyz';
                $replyName = 'NO REPLY';
            } else {
                $replyName = $this->name;
            }

            $data = [
                'name' => $this->name,
                'reason' => $this->subject,
                'message' => $this->message,
                'sendFrom' => $this->email,
                'replyName' => $replyName,
            ];

            $this->sendEmail($data);
        } catch (TooManyRequestsException $exception) {
            //Disable the send button so the user does not attempt to resend a message again
            $this->dispatchBrowserEvent('disable-send-button');

            throw ValidationException::withMessages([
                'message' => "You need to wait another $exception->minutesUntilAvailable minutes before you can submit this form again.",
            ]);
        }
    }

    /**
     * Sends email with form data
     * @param  array  $data
     * @return void
     */
    public function sendEmail(array $data): void
    {
        Mail::to('mail@schedulist.xyz')->send(new FeedbackForm($data));

        $this->reset('message');
        $this->emit(
            'toastMessage',
            'Message sent! We\'ll get back to you as soon as possible.'
        );
        $this->dispatchBrowserEvent('reset-form');
    }

    /**
     * Sets value of subject property from select component
     * @param string $value
     */
    public function setSubject(string $value): void
    {
        $this->subject = $value;
    }

    /**
     * Render the component
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        return view('livewire.contact.contact-form')->layout('layouts.guest', [
            'title' => 'Contact Us',
        ]);
    }
}
