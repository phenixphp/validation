<?php

declare(strict_types=1);

namespace Phenix\Validation\Rules;

use DateTimeInterface;
use Phenix\Validation\Util\Date;

class EqualDates extends Rule
{
    protected Date $date;

    public function __construct(DateTimeInterface|string $date)
    {
        $this->date = Date::parse($date);
    }

    public function passes(): bool
    {
        return Date::parse($this->getValue())->equalTo($this->date);
    }
}
