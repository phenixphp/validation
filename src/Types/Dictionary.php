<?php

declare(strict_types=1);

namespace Phenix\Validation\Types;

use Phenix\Validation\Exceptions\InvalidDictionaryDefinition;
use Phenix\Validation\Rules\IsDictionary;
use Phenix\Validation\Rules\Min;
use Phenix\Validation\Rules\TypeRule;

class Dictionary extends ArrType
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

    public function max(int $limit): self
    {
        return $this;
    }

    protected function defineType(): TypeRule
    {
        return IsDictionary::new();
    }

    protected function throwsError(): never
    {
        throw new InvalidDictionaryDefinition('The dictionary definition is invalid.');
    }

    protected function isValidDefinition(array $definition): bool
    {
        foreach ($definition as $key => $value) {
            if (! is_string($key) || ! $value instanceof Scalar) {
                return false;
            }
        }

        return true;
    }
}
