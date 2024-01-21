<?php

declare(strict_types=1);

namespace Phenix\Validation\Types;

use Phenix\Validation\Contracts\Rule;
use Phenix\Validation\Contracts\TypingRule;
use Phenix\Validation\Rules\IsArray;

class ArrObject extends ArrType
{
    public function define(array $definition): self
    {
        // TODO: Every
        $this->definition = $definition;

        return $this;
    }

    protected function defineType(): Rule&TypingRule
    {
        return IsArray::new();
    }
}
