<?php

declare(strict_types=1);

namespace Phenix\Validation\Contracts;

interface Rule
{
    public function setField(string $field): self;

    public function setData(array $data): self;

    public function passes(): bool;

    public function message(): string;
}
