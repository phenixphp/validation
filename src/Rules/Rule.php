<?php

declare(strict_types=1);

namespace Phenix\Validation\Rules;

use Adbar\Dot;
use Phenix\Validation\Contracts\Rule as RuleContract;

abstract class Rule implements RuleContract
{
    protected string $field;
    protected Dot $data;

    public static function new(mixed ...$args): static
    {
        return new static(...$args);
    }

    abstract public function passes(): bool;

    abstract public function message(): string;

    public function setField(string $field): self
    {
        $this->field = $field;

        return $this;
    }

    public function setData(array $data): self
    {
        $this->data = new Dot($data);

        return $this;
    }

    protected function getValue(): array|string|int|float|bool|null
    {
        return $this->data->get($this->field) ?? null;
    }
}
