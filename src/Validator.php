<?php

declare(strict_types=1);

namespace Phenix\Validation;

use Adbar\Dot;
use ArrayIterator;
use Phenix\Validation\Contracts\Rule;
use Phenix\Validation\Contracts\Type;
use Phenix\Validation\Types\ArrType;
use Phenix\Validation\Types\Collection;
use Phenix\Validation\Types\Dictionary;

use function array_filter;
use function array_unique;
use function in_array;
use function is_null;

class Validator
{
    protected Dot $data;
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
        $this->data = new Dot($data);

        return $this;
    }

    public function validate(): array
    {
        $this->reset();

        $this->checkRules($this->rules);

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
        return $this->getDataFromKeys(array_unique($this->validated));
    }

    public function failing(): array
    {
        return $this->failing;
    }

    public function invalid(): array
    {
        return $this->getDataFromKeys(array_keys($this->failing));
    }

    private function reset(): void
    {
        $this->failing = [];
        $this->validated = [];
        $this->rules->rewind();
    }

    private function checkRules(ArrayIterator $rules, string|int|null $parent = null): void
    {
        while ($rules->valid() && ! $this->shouldStop()) {
            $field = $rules->key();

            /** @var Type $type */
            $type = $rules->current();

            $ruleSet = $type->toArray();

            $passes = true;

            foreach ($ruleSet['type'] as $rule) {
                $passes = $this->checkRule($field, $rule, $parent);

                if (! $passes) {
                    break;
                }
            }

            if ($type instanceof ArrType) {
                $defRules = new ArrayIterator($ruleSet['definition'] ?? []);

                if ($type instanceof Collection) {
                    $this->checkCollection($defRules, $this->implodeKeys([$parent, $field]));
                } else {
                    $this->checkRules($defRules, $this->implodeKeys([$parent, $field]));
                }
            }

            $rules->next();
        }
    }

    private function checkRule(string $field, Rule $rule, string|int|null $parent = null): bool
    {
        $field = $this->implodeKeys([$parent, $field]);

        $rule->setField($field)
            ->setData($this->data);

        $passes = $rule->passes();

        if (! $passes) {
            $this->failing[$field][] = $rule::class;
        }

        $this->validated[] = $field;

        return $passes;
    }

    private function checkCollection(ArrayIterator $rules, string|int|null $parent = null): void
    {
        $count = is_null($parent) ? count($this->data) : count($this->data[$parent]);

        for ($i = 0; $i < $count; $i++) {
            $this->checkRules($rules, $this->implodeKeys([$parent, $i]));

            $rules->rewind();
        }
    }

    private function implodeKeys(array $keys): string
    {
        return implode('.', array_filter($keys, fn ($key) => ! is_null($key)));
    }

    private function getDataFromKeys(array $keys)
    {
        $validated = new Dot();

        foreach ($keys as $key) {
            $rule = $this->rules[$key] ?? null;

            if ($rule && in_array($rule::class, [Collection::class, Dictionary::class])) {
                $validated->set($key, []);
            } else {
                $validated->set($key, $this->data->get($key));
            }
        }

        return $validated->all();
    }
}
