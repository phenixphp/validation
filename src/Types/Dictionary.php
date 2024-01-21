<?php

declare(strict_types=1);

namespace Phenix\Validation\Types;

use Phenix\Validation\Contracts\Rule;
use Phenix\Validation\Contracts\TypingRule;
use Phenix\Validation\Rules\IsDictionary;
use Phenix\Validation\Rules\Min;

class Dictionary extends ArrType
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

    public function max(int $limit): self
    {
        return $this;
    }

    protected function defineType(): Rule&TypingRule
    {
        return IsDictionary::new();
    }
}
