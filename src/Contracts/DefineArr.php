<?php

declare(strict_types=1);

namespace Phenix\Validation\Contracts;

interface DefineArr
{
    public function define((Rule&TypingRule)|array $definition): static;
}
