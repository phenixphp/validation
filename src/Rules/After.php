<?php

declare(strict_types=1);

namespace Phenix\Validation\Rules;

use Phenix\Validation\Util\Date;

class After extends EqualDates
{
    public function passes(): bool
    {
        return Date::parse($this->getValue())->greaterThan($this->date);
    }
}
