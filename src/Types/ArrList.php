<?php

declare(strict_types=1);

namespace Phenix\Validation\Types;

use Phenix\Validation\Contracts\Rule;
use Phenix\Validation\Contracts\TypingRule;
use Phenix\Validation\Rules\IsList;

class ArrList extends ArrType
{
    public function define(Rule&TypingRule $definition): self
    {
        // TODO: Every
        $this->definition = $definition;

        return $this;
    }

    protected function defineType(): Rule&TypingRule
    {
        return IsList::new();
    }
}