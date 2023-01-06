<?php

namespace App\Services\Twilio;

use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class PhoneNumberLookupService {
    private Client $client;

    public string $carrier;

    public function __construct(string $authSID, string $authToken) {
        $this->client = new Client($authSID, $authToken);
    }

    public function validate(string $phoneNumber): bool {
        if (empty($phoneNumber)) {
            return false;
        }

        try {
            $lookup = $this->client
                ->lookups
                ->v1
                ->phoneNumbers($phoneNumber)
                ->fetch(["countryCode" => "US", "type" => ["carrier"]]);

            $this->carrier = $lookup->carrier['name'];
        } catch (TwilioException) {
            return false;
        }

        return true;
    }
}
