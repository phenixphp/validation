<?php

declare(strict_types=1);

namespace Phenix\Validation\Rules;

class URL extends Rule
{
    public function passes(): bool
    {
        return filter_var($this->getValue(), FILTER_VALIDATE_URL) !== false;
    }
}
