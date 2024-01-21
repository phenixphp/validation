<?php

declare(strict_types=1);

namespace Phenix\Validation\Types;

use Phenix\Validation\Contracts\Rule;
use Phenix\Validation\Contracts\TypingRule;

abstract class ArrType extends Type
{
    protected (Rule&TypingRule)|array $definition;

    public function toArray(): array
    {
        return [
            ...parent::toArray(),
            ...['definition' => $this->definition],
        ];
    }
}
