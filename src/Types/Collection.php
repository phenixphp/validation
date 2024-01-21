<?php

declare(strict_types=1);

namespace Phenix\Validation\Types;

use Phenix\Validation\Rules\Min;
use Phenix\Validation\Contracts\Rule;
use Phenix\Validation\Rules\IsCollection;
use Phenix\Validation\Contracts\TypingRule;

class Collection extends ArrType
{
    public function define(array $definition): self
    {
        // TODO: Every
        $this->definition = $definition;

        return $this;
    }

    public function min(int $limit): self
    {
        $this->rules[] = Min::new($limit);

        return $this;
    }

    protected function defineType(): Rule&TypingRule
    {
        return IsCollection::new();
    }
}
