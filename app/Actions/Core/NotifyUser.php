<?php

namespace App\Actions\Core;

use App\Helpers\CarrierEmailHelper;
use App\Jobs\SendText;
use App\Jobs\SendStdEmail;

/**
 * Dispatches notification to user's selected notification channels 
 */
class NotifyUser {

    /**
     * Message to send to user
     */
    public $message;

    public $user;

    public function __construct($message, $user) {
        $this->message = $message;
        $this->user = $user;
    }

    /**
     * Creates a new instance of self with user data
     *
     * @param App/Models/User $user
     * @return App/Models/NotifyUser
     */
    public static function createNotification($message, $user) {
        return new NotifyUser($message, $user);
    }

    /**
     * Dispatch email to user
     *
     * @param string $template email template to use (defaults to plaintext email on Schedulist template)
     * @return $this
     */
    public function sendEmail($template = null) {
        $user = $this->user;
        $details = ['email' => $user->email, 'data' => $this->message];
        SendStdEmail::dispatch($details, $template);
        return $this;
    }

    /**
     * Dispatch text message to user
     *
     * @return $this
     */
    public function sendText() {
        $user = $this->user;
        $details = ['email' => $user->phone . CarrierEmailHelper::getCarrierEmail($user->carrier), 'message' => $this->message];
        SendText::dispatchSync($details);
        return $this;
    }

    /**
     * Send additional texts after first text
     *
     * @param string $message
     * @return $this
     */
    public function addText($message) {
        $user = $this->user;
        $details = ['email' => $user->phone . CarrierEmailHelper::getCarrierEmail($user->carrier), 'message' => $message];
        SendText::dispatchSync($details);
        return $this;
    }
}
