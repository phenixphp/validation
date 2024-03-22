<?php

declare(strict_types=1);

namespace Phenix\Validation\Rules;

use DateTime;
use Throwable;

use function is_string;

class IsDate extends IsString
{
    public function passes(): bool
    {
        $value = $this->getValue();

        try {
            $dateTime = new DateTime($value);

            return is_string($value) && $dateTime;
        } catch (Throwable) {
            return false;
        }

    }
}
