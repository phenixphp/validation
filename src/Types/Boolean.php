<?php

declare(strict_types=1);

namespace Phenix\Validation\Types;

use Phenix\Validation\Rules\IsBool;
use Phenix\Validation\Rules\TypeRule;

class ArrObject extends Scalar
{
    protected function defineType(): TypeRule
    {
        return IsBool::new();
    }
}

// aditionals? 1, 0, "1", and "0".
