<?php

declare(strict_types=1);

namespace Phenix\Validation\Rules;

use function is_array;
use function array_is_list;
use Phenix\Validation\Contracts\TypingRule;

class IsDictionary extends IsList
{
    public function passes(): bool
    {
        $value = $this->getValue();

        return is_array($value)
            && ! array_is_list($value)
            && $this->isScalar($value);
    }

    public function message(): string
    {
        return "The {$this->field} field must be dictionary type.";
    }
}
