<?php

declare(strict_types=1);

namespace Phenix\Validation\Rules;

use Phenix\Validation\Contracts\RequirementRule;

class Nullable extends Rule implements RequirementRule
{
    public function passes(): bool
    {
        $value = $this->getValue();

        if (! empty($value)) {
            return parent::passes($value);
        }

        return true;
    }

    public function message(): string
    {
        return "The {$this->field} field must be filled.";
    }
}
