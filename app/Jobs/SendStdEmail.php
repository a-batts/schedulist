<?php

namespace App\Jobs;

use App\Mail\StdEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendStdEmail implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $details;
    public $template = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $details, $template) {
        $this->user = $user;
        $this->details = $details;
        $this->template = $template;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        Mail::to($this->user)->send(new StdEmail($this->details, $this->template));
    }
}
