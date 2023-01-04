<?php

namespace App\Actions\Core;

use App\Helpers\CarrierEmailHelper;
use App\Jobs\SendText;
use App\Jobs\SendStdEmail;
use App\Models\User;

/**
 * Dispatches notification to user's selected notification channels 
 */
class NotifyUser {

    /**
     * Message to send to user
     */
    public $message;

    public $user;

    public function __construct(array|string $message, User $user) {
        $this->message = $message;
        $this->user = $user;
    }

    /**
     * Creates a new instance of self with user data
     *
     * @param User $user
     * @return NotifyUser
     */
    public static function createNotification(array|string $message, User $user): NotifyUser {
        return new NotifyUser($message, $user);
    }

    /**
     * Dispatch email to user
     *
     * @param string $template email template to use (defaults to plaintext email on Schedulist template)
     * @return NotifyUser
     */
    public function sendEmail(?string $template = null): NotifyUser {
        SendStdEmail::dispatch(
            data: $this->message,
            template: $template,
            user: $this->user
        );
        return $this;
    }

    /**
     * Dispatch text message to user
     *
     * @return NotifyUser
     */
    public function sendText(): NotifyUser {
        $user = $this->user;
        if ($user->phone != null) {
            $details = ['email' => $user->phone . CarrierEmailHelper::getCarrierEmail($user->carrier), 'message' => $this->message];
            SendText::dispatchSync($details);
        }
        return $this;
    }

    /**
     * Send additional texts after first text
     *
     * @param string $message
     * @return NotifyUser
     */
    public function addText(string $message): NotifyUser {
        $user = $this->user;
        $details = ['email' => $user->phone . CarrierEmailHelper::getCarrierEmail($user->carrier), 'message' => $message];
        SendText::dispatchSync($details);
        return $this;
    }
}
