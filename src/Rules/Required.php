<?php

declare(strict_types=1);

namespace Phenix\Validation\Rules;

use function count;

use function is_countable;
use function is_null;
use function is_string;

use Phenix\Validation\Contracts\RequirementRule;

use function trim;

class Required extends Rule implements RequirementRule
{
    public function passes(): bool
    {
        $value = $this->getValue();

        return ! is_null($value)
            || (is_string($value) && ! empty(trim($value)))
            || (is_countable($value) && count($value) > 0);
    }

    public function message(): string
    {
        return "The {$this->field} field is required.";
    }
}
