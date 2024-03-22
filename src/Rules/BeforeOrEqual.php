<?php

declare(strict_types=1);

namespace Phenix\Validation\Rules;

use Phenix\Validation\Util\Date;

class BeforeOrEqual extends Before
{
    public function passes(): bool
    {
        return Date::parse($this->getValue())->lessThanOrEqualTo($this->date);
    }
}
