<?php

declare(strict_types=1);

namespace Phenix\Validation\Rules;

use Phenix\Validation\Contracts\TypingRule;

use function is_array;

class IsArray extends Rule implements TypingRule
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
