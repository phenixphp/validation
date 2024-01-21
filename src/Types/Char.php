<?php

declare(strict_types=1);

namespace Phenix\Validation\Types;

use Phenix\Validation\Contracts\Rule;
use Phenix\Validation\Contracts\TypingRule;
use Phenix\Validation\Rules\IsString;

class Char extends Type
{
    protected function defineType(): Rule&TypingRule
    {
        return IsString::new(); // ASCII
    }
}
