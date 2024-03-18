<?php

declare(strict_types=1);

namespace Phenix\Validation\Rules;

class DoesNotStartsWith extends StartsWith
{
    public function passes(): bool
    {
        return !parent::passes();
    }
}
