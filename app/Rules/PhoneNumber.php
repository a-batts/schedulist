<?php

namespace App\Rules;

use App\Services\Twilio\PhoneNumberLookupService;
use Illuminate\Contracts\Validation\Rule;

class PhoneNumber implements Rule {
    private $service;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(
        PhoneNumberLookupService $phoneNumberLookupService
    ) {
        $this->service = $phoneNumberLookupService;
    }


    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool {
        return $this->service->validate($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() {
        return 'The phone number has to be in either national or international format.';
    }
}
