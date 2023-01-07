<?php

namespace App\Jobs;

use App\Mail\StdEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendStdEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Email data
     *
     * @var array
     */
    public array $data;

    /**
     * The template to use for the email
     *
     * @var string|null
     */
    public ?string $template = null;

    /**
     * The user to send the email to
     *
     * @var User
     */
    public User $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $data, ?string $template, User $user)
    {
        $this->data = $data;
        $this->template = $template;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->data['user_email'] = $this->user->email;
        Mail::to($this->user)->send(new StdEmail($this->data, $this->template));
    }
}
