<?php

declare(strict_types=1);

namespace Phenix\Validation\Rules;

class Between extends Size
{
    protected int $min;
    protected int $max;

    public function __construct(int $min, int $max)
    {
        $this->min = abs($min);
        $this->max = abs($max);
    }

    public function passes(): bool
    {
        $value = $this->getValue();

        return $value >= $this->min && $value <= $this->max;
    }
}
