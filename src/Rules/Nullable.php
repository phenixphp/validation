<?php

declare(strict_types=1);

namespace Phenix\Validation\Rules;

use Phenix\Validation\Contracts\RequirementRule;

class Nullable extends Rule implements RequirementRule
{
    public function passes(): bool
    {
        return true;
    }
}
