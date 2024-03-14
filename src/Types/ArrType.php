<?php

declare(strict_types=1);

namespace Phenix\Validation\Types;

use Phenix\Validation\Rules\Max;
use Phenix\Validation\Rules\Min;

abstract class ArrType extends Type
{
    protected Scalar|array $definition;

    public function min(int $limit): static
    {
        $this->rules[] = Min::new($limit);

        return $this;
    }

    public function max(int $limit): static
    {
        $this->rules[] = Max::new($limit);

        return $this;
    }

    public function toArray(): array
    {
        return [
            ...parent::toArray(),
            ...['definition' => $this->definition],
        ];
    }
}
