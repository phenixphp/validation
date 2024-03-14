<?php

declare(strict_types=1);

namespace Phenix\Validation\Contracts;

interface Type extends Arrayable
{
    public function isRequired(): bool;
}
