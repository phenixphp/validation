<?php

declare(strict_types=1);

namespace Phenix\Validation\Rules;

use Countable;

use function gettype;

class Min extends Rule
{
    protected float|int $limit;

    public function __construct(float|int $limit)
    {
        $this->limit = abs($limit);
    }

    public function passes(): bool
    {
        return $this->getValue() >= $this->limit;
    }

    public function message(): string
    {
        return "The {$this->field} field must be string type.";
    }

    protected function getValue(): array|string|int|float|bool|null
    {
        $value = $this->data->get($this->field) ?? null;

        return match (gettype($value)) {
            'string' => strlen($value),
            'array' => count($value),
            'integer', 'double' => $value,
            'object' => $this->resolveCountableObject($value),
            default => 0,
        };
    }

    private function resolveCountableObject(object $value): int
    {
        $count = 0;

        if ($value instanceof Countable) {
            $count = $value->count();
        }

        return $count;
    }
}
