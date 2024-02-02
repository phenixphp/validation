<?php

declare(strict_types=1);

namespace Phenix\Validation;

use ArrayIterator;
use Phenix\Validation\Contracts\Rule;
use Phenix\Validation\Contracts\Type;
use Phenix\Validation\Types\ArrType;
use Phenix\Validation\Types\Collection;

class Validator
{
    protected array $data;
    protected ArrayIterator $rules;
    protected bool $stopOnFail = false;
    protected array $failing = [];
    protected array $validated = [];
    protected array $errors = [];

    public function setRules(array $rules = []): self
    {
        $this->rules = new ArrayIterator($rules);

        return $this;
    }

    public function setData(array $data = []): self
    {
        $this->data = $data;

        return $this;
    }

    public function validate(): array
    {
        $this->reset();

        $this->checkRules($this->rules, $this->data);

        return $this->validated;

        // foreach ($this->after as $after) {
        //     $after();
        // }

        return $this->validated();
    }

    public function passes(): bool
    {
        $this->validate();

        return empty($this->failing);
    }

    public function fails(): bool
    {
        return ! $this->passes();
    }

    public function shouldStop(): bool
    {
        return $this->stopOnFail && $this->fails();
    }

    public function validated(): array
    {
        return array_unique($this->validated);
    }

    private function reset(): void
    {
        $this->failing = [];
        $this->validated = [];
        $this->rules->rewind();
    }

    private function checkRules(ArrayIterator $rules, array $data, string|int|null $parent = null): void
    {
        while ($rules->valid() && ! $this->shouldStop()) {
            $field = $rules->key();

            /** @var Type $type */
            $type = $rules->current();

            $ruleSet = $type->toArray();

            foreach ($ruleSet['type'] as $rule) {
                $this->checkRule($field, $rule, $data, $parent);
            }

            if ($type instanceof ArrType) {
                $defRules = new ArrayIterator($ruleSet['definition'] ?? []);

                if ($type instanceof Collection) {
                    $this->checkCollection($defRules, $data ?? [], $this->implodeKeys([$parent, $field]));
                } else {
                    $this->checkRules($defRules, $data, $this->implodeKeys([$parent, $field]));
                }
            }

            $rules->next();
        }
    }

    private function checkRule(string $field, Rule $rule, array $data, string|int|null $parent = null): void
    {
        $field = $this->implodeKeys([$parent, $field]);

        $rule->setField($field)
            ->setData($data);

        if (! $rule->passes()) {
            $this->failing[$field] = $rule::class;
        }

        $this->validated[] = $field;
    }

    private function checkCollection(ArrayIterator $rules, array $data, string|int|null $parent = null): void
    {
        $count = count($data);

        for ($i = 0; $i < $count; $i++) {
            $this->checkRules($rules, $data, $this->implodeKeys([$parent, $i]));
        }
    }

    private function implodeKeys(array $keys): string
    {
        return implode('.', array_filter($keys, fn ($key) => ! is_null($key)));
    }
}
