<?php

namespace App\Helpers;

class CarrierEmailHelper {
    private static array $carrierEmails = [
        'Verizon Wireless' => '@vtext.com',
        'T-Mobile' => '@tmomail.net',
        'T-Mobile USA, Inc.' => '@tmomail.net',
        'AT&T Wireless' => '@txt.att.net',
        'Sprint' => '@messaging.sprintpcs.com',
        'Google (Grand Central) BWI - Bandwidth.com - SVR' => null,
    ];

    /**
     * Returns the email for a provided carrier
     *
     * @param string $carrierName
     * @return string|null email for provided carrier or null if the carrier does not have an associated email
     */
    public static function getCarrierEmail($carrierName) {
        if (static::$carrierEmails[$carrierName] != null)
            return self::$carrierEmails[$carrierName];
        return null;
    }
}
