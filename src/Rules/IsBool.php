<?php

declare(strict_types=1);

namespace Phenix\Validation\Rules;

class IsBool extends TypeRule
{
    public function passes(): bool
    {
        return is_bool($this->getValue());
    }

    public function message(): string
    {
        return "The {$this->field} field must be string type.";
    }
}
