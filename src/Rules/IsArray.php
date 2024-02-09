<?php

declare(strict_types=1);

namespace Phenix\Validation\Rules;

use function is_array;

class IsArray extends TypeRule
{
    public function passes(): bool
    {
        return is_array($this->getValue());
    }

    public function message(): string
    {
        return "The {$this->field} field must be array type.";
    }
}
