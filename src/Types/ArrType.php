<?php

declare(strict_types=1);

namespace Phenix\Validation\Types;

use Phenix\Validation\Rules\TypeRule;

abstract class ArrType extends Type
{
    protected TypeRule|array $definition;

    public function toArray(): array
    {
        return [
            ...parent::toArray(),
            ...['definition' => $this->definition],
        ];
    }
}
