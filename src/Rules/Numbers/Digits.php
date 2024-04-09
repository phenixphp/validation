<?php

declare(strict_types=1);

namespace Phenix\Validation\Rules\Numbers;

use Phenix\Validation\Rules\Rule;

class Digits extends Rule
{
    protected int $digits;

    public function __construct(int $digits)
    {
        $this->digits = abs($digits);
    }

    public function passes(): bool
    {
        $number = (string) $this->getValue();

        return strlen($number) === $this->digits;
    }
}
