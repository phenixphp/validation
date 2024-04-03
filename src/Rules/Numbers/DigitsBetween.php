<?php

declare(strict_types=1);

namespace Phenix\Validation\Rules\Numbers;

use Phenix\Validation\Rules\Between;

class DigitsBetween extends Between
{
    public function passes(): bool
    {
        $digits = strlen((string) $this->getValue());

        return $digits >= $this->min && $digits <= $this->max;
    }
}
