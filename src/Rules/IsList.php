<?php

declare(strict_types=1);

namespace Phenix\Validation\Rules;

use function array_is_list;
use function is_array;

use Phenix\Validation\Contracts\TypingRule;

class IsList extends Rule implements TypingRule
{
    public function passes(): bool
    {
        $value = $this->getValue();

        return is_array($value)
            && array_is_list($value)
            && $this->isScalar($value);
    }

    public function message(): string
    {
        return "The {$this->field} field must be list type.";
    }

    protected function isScalar(array $data): bool
    {
        foreach ($data as $item) {
            if (! is_scalar($item)) {
                return false;
            }
        }

        return true;
    }
}
