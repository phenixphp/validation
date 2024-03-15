<?php

declare(strict_types=1);

namespace Phenix\Validation\Types;

use Phenix\Validation\Rules\IsString;
use Phenix\Validation\Rules\Max;
use Phenix\Validation\Rules\Min;
use Phenix\Validation\Rules\RegEx;
use Phenix\Validation\Rules\Size;
use Phenix\Validation\Rules\TypeRule;

class Str extends Scalar
{
    protected function defineType(): TypeRule
    {
        return IsString::new();
    }

    public function min(int $limit): self
    {
        $this->rules['min'] = Min::new($limit);

        return $this;
    }

    public function max(int $limit): self
    {
        $this->rules['max'] = Max::new($limit);

        return $this;
    }

    public function size(int $limit): self
    {
        $this->rules['size'] = Size::new($limit);

        return $this;
    }

    public function regex(string $regex): self
    {
        $this->rules['regex'] = RegEx::new($regex);

        return $this;
    }

    public function matchAlpha(): self
    {
        return $this;
    }

    public function matchAlphaNum(): self
    {
        return $this;
    }

    public function matchAlphaDash(): self
    {
        return $this;
    }

    public function url(): self
    {
        return $this;
    }

    public function activeUrl(): self
    {
        return $this;
    }

    public function in(array $values): self
    {
        return $this;
    }

    public function notIn(array $values): self
    {
        return $this;
    }

    public function email(): self
    {
        return $this;
    }

    public function startWidth(string $value): self
    {
        return $this;
    }

    public function endWidth(string $value): self
    {
        return $this;
    }

    public function doesNotStartWidth(string $value): self
    {
        return $this;
    }

    public function doesNotEndWidth(string $value): self
    {
        return $this;
    }

    public function uuid(): self
    {
        return $this;
    }

    public function ulid(): self
    {
        return $this;
    }

    // password
}
