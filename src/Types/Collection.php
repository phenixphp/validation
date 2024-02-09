<?php

declare(strict_types=1);

namespace Phenix\Validation\Types;

use function is_string;

use Phenix\Validation\Exceptions\InvalidCollectionDefinition;
use Phenix\Validation\Rules\IsCollection;
use Phenix\Validation\Rules\Min;

use Phenix\Validation\Rules\TypeRule;

class Collection extends ArrType
{
    public function define(array $definition): self
    {
        if (array_is_list($definition) || ! $this->isValidDefinition($definition)) {
            $this->throwsError();
        }

        $this->definition = $definition;

        return $this;
    }

    public function min(int $limit): self
    {
        $this->rules[] = Min::new($limit);

        return $this;
    }

    protected function defineType(): TypeRule
    {
        return IsCollection::new();
    }

    protected function throwsError(): never
    {
        throw new InvalidCollectionDefinition('The collection definition is invalid.');
    }

    protected function isValidDefinition(array $definition): bool
    {
        foreach ($definition as $key => $value) {
            if (! is_string($key) || ! $value instanceof Type) {
                return false;
            }
        }

        return true;
    }
}
