<?php

declare(strict_types=1);

namespace Phenix\Validation\Types;

use Phenix\Validation\Rules\IsString;
use Phenix\Validation\Rules\TypeRule;

class Char extends Type
{
    protected function defineType(): TypeRule
    {
        return IsString::new(); // ASCII
    }
}
