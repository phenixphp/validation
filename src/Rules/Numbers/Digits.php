<?php

declare(strict_types=1);

namespace Phenix\Validation\Rules\Numbers;

use Phenix\Validation\Rules\Rule;

class Digits extends Rule
{
    public function __construct(
        protected int $digits
    ) {
    }

    public function passes(): bool
    {
        $number = $this->getValue();

        return strlen($number) === $this->digits;
    }
}
