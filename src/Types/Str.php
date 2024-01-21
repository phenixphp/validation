<?php

declare(strict_types=1);

namespace Phenix\Validation\Types;

use Phenix\Validation\Contracts\Rule;
use Phenix\Validation\Contracts\TypingRule;
use Phenix\Validation\Rules\IsString;

class Str extends Type
{
    protected function defineType(): Rule&TypingRule
    {
        return IsString::new();
    }

    public function min(int $limit): self
    {
        return $this;
    }

    public function max(int $limit): self
    {
        return $this;
    }

    public function size(int $limit): self
    {
        return $this;
    }

    public function regex(string $regex): self
    {
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
