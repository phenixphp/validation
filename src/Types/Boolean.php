<?php

declare(strict_types=1);

namespace Phenix\Validation\Types;

use Phenix\Validation\Contracts\Rule;
use Phenix\Validation\Contracts\TypingRule;
use Phenix\Validation\Rules\IsBool;

class ArrObject extends Type
{
    protected function defineType(): Rule&TypingRule
    {
        return IsBool::new();
    }
}

// aditionals? 1, 0, "1", and "0".