<?php

declare(strict_types=1);

namespace Phenix\Validation\Rules;

use function is_string;

use Phenix\Validation\Contracts\TypingRule;

class IsString extends Rule implements TypingRule
{
    public function passes(): bool
    {
        return is_string($this->getValue());
    }

    public function message(): string
    {
        return "The {$this->field} field must be string type.";
    }
}
