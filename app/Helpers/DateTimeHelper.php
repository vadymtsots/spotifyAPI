<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Date;

class DateTimeHelper
{
    public static function getTimeString(int $duration): string
    {
        return Date::createFromTimestampMs($duration)->toTimeString();
    }

    public static function getReleaseDateString(string $date): string
    {
        $dateTimestamp = strtotime($date);
        return Date::createFromTimestamp($dateTimestamp)->format('j F Y');
    }
}
